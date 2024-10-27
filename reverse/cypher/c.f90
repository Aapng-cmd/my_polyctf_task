program caesar_cipher
    use, intrinsic :: iso_c_binding
    implicit none

    ! Include GMP functions
    interface
        subroutine mpz_init(z) bind(c, name="mpz_init")
            type(c_ptr), intent(out) :: z
        end subroutine mpz_init

        subroutine mpz_set_str(z, str, base) bind(c, name="mpz_set_str")
            type(c_ptr), intent(out) :: z
            character(len=*), intent(in) :: str
            integer(c_int), intent(in) :: base
        end subroutine mpz_set_str

        subroutine mpz_clear(z) bind(c, name="mpz_clear")
            type(c_ptr), intent(in) :: z
        end subroutine mpz_clear

        function mpz_get_str(str, base, z) bind(c, name="mpz_get_str")
            character(len=*) :: str
            integer(c_int), intent(in) :: base
            type(c_ptr), intent(in) :: z
        end function mpz_get_str

        subroutine mpz_add(res, op1, op2) bind(c, name="mpz_add")
            type(c_ptr), intent(out) :: res
            type(c_ptr), intent(in) :: op1, op2
        end subroutine mpz_add

        subroutine mpz_sub(res, op1, op2) bind(c, name="mpz_sub")
            type(c_ptr), intent(out) :: res
            type(c_ptr), intent(in) :: op1, op2
        end subroutine mpz_sub

        subroutine mpz_mul(res, op1, op2) bind(c, name="mpz_mul")
            type(c_ptr), intent(out) :: res
            type(c_ptr), intent(in) :: op1, op2
        end subroutine mpz_mul

        subroutine mpz_mod(res, op1, op2) bind(c, name="mpz_mod")
            type(c_ptr), intent(out) :: res
            type(c_ptr), intent(in) :: op1, op2
        end subroutine mpz_mod
    end interface

    type(c_ptr) :: key, current_key
    character(len=100) :: FLAG
    character(len=100) :: ans
    character(len=100) :: key_str

    ! Initialize key
    call mpz_init(key)
    call mpz_init(current_key)

    read(*, *) FLAG
    call mpz_set_str(key, "0", 10)  ! Set initial key to 0

    ans = encode(FLAG, key)
    call mpz_get_str(key_str, 10, key)  ! Get key as string
    print *, trim(ans), trim(key_str)  ! Print the result

    ! Clear GMP variables
    call mpz_clear(key)
    call mpz_clear(current_key)

contains

    function caesar_encode(text, shift) result(encoded_text)
        character(len=*), intent(in) :: text
        type(c_ptr), intent(in) :: shift  ! Use GMP type
        character(len=100) :: encoded_text
        INTEGER :: i, char_code
        type(c_ptr) :: temp_shift

        call mpz_init(temp_shift)
        call mpz_set_str(temp_shift, "0", 10)  ! Initialize temp_shift

        encoded_text = ""
        do i = 1, len_trim(text)
            char_code = iachar(text(i:i))
            if (char_code >= iachar('A') .and . char_code <= iachar('Z')) then
                call mpz_mod(temp_shift, char_code - iachar('A') + shift, 26)
                encoded_text = trim(encoded_text) // achar(modd(temp_shift) + iachar('A'))
            else if (char_code >= iachar('a') .and. char_code <= iachar('z')) then
                call mpz_mod(temp_shift, char_code - iachar('a') + shift, 26)
                encoded_text = trim(encoded_text) // achar(modd(temp_shift) + iachar('a'))
            else if (char_code >= iachar('0') .and. char_code <= iachar('9')) then
                call mpz_mod(temp_shift, char_code - iachar('0') + shift, 10)
                encoded_text = trim(encoded_text) // achar(modd(temp_shift) + iachar('0'))
            else
                encoded_text = trim(encoded_text) // text(i:i)
            end if
        end do

        call mpz_clear(temp_shift)  ! Clear temp_shift
    end function caesar_encode

    function modd(num, sh) result(ans)
        type(c_ptr), intent(in) :: num
        INTEGER(KIND=4), intent(in) :: sh
        type(c_ptr) :: ans
        type(c_ptr) :: temp_num

        call mpz_init(ans)
        call mpz_init(temp_num)

        call mpz_mod(temp_num, num, sh)
        call mpz_set(ans, temp_num)

        call mpz_clear(temp_num)  ! Clear temp_num
    end function modd

    function encode(string, key) result(ans)
        character(len=*), intent(in) :: string
        type(c_ptr), intent(inout) :: key
        character(len=100) :: ans
        character(len=100) :: s
        INTEGER :: i, el
        character(len=1) :: actions(3)
        type(c_ptr) :: current_key

        call mpz_init(current_key)

        actions(1) = '-'
        actions(2) = '*'
        actions(3) = '+'
        s = to_hex(string)  ! Convert string to hexadecimal
        call mpz_set(current_key, key)  ! Initialize current_key
        ans = ""

        do i = 1, len_trim(s)
            el = iachar(s(i:i))
            call eval_key(current_key, actions(mod(i-1, 3)+1), el)
            ans = trim(ans) // caesar_encode(s(i:i), current_key)
        end do

        call mpz_set(key, current_key)  ! Update the key with the final value
        call mpz_clear(current_key)  ! Clear current_key
    end function encode

    function to_hex(string) result(hex_string)
        character(len=*), intent(in) :: string
        character(len=100) :: hex_string
        INTEGER :: i

        hex_string = ""  ! Initialize the hex_string
        do i = 1, len_trim(string)
            hex_string = trim(hex_string) // to_hex_char(iachar(string(i:i)))
        end do
    end function to_hex

    function to_hex_char(char_code) result(hex_char)
        INTEGER(KIND=4), intent(in) :: char_code
        character(len=2) :: hex_char

        write(hex_char, '(Z2)') char_code
    end function to_hex_char

    function eval_key(current_key, action, value) result(new_key)
        type(c_ptr), intent(inout) :: current_key
        character(len=1), intent(in) :: action
        INTEGER(KIND=4), intent(in) :: value
        type(c_ptr) :: new_key
        type(c_ptr) :: temp_key

        call mpz_init(new_key)
        call mpz_init(temp_key)

        select case (action)
        case ('-')
            call mpz_sub(temp_key, current_key, value)
            call mpz_set(new_key, temp_key)
        case ('*')
            call mpz_mul(temp_key, current_key, value)
            call mpz_set(new_key, temp_key)
        case ('+')
            call mpz_add(temp_key, current_key, value)
            call mpz_set(new_key, temp_key)
        end select

        call mpz_set(current_key, new_key)  ! Update current_key
        call mpz_clear(temp_key)  ! Clear temp_key
        call mpz_clear(new_key)  ! Clear new_key
    end function eval_key

end program caesar_cipher
