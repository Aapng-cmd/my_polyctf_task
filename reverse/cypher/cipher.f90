program caesar_cipher
    implicit none
    character(len=100) :: FLAG
    character(len=100) :: ans
    INTEGER(KIND=16) :: key

    read(*, *) FLAG
    key = 0  ! Initialize key
    
    ans = encode(FLAG, key)
    print *, trim(ans), key  ! Print the result

contains

    function caesar_encode(text, shift) result(encoded_text)
        character(len=*), intent(in) :: text
        INTEGER(KIND=16), intent(in) :: shift
        character(len=100) :: encoded_text
        INTEGER(KIND=16) :: i, char_code

        encoded_text = ""
        do i = 1, len_trim(text)
            char_code = iachar(text(i:i))
            if (char_code >= iachar('A') .and. char_code <= iachar('Z')) then
                encoded_text = trim(encoded_text) // achar(modd(char_code - iachar('A') + shift, 26) + iachar('A'))
            else if (char_code >= iachar('a') .and. char_code <= iachar('z')) then
                encoded_text = trim(encoded_text) // achar(modd(char_code - iachar('a') + shift, 26) + iachar('a'))
            else if (char_code >= iachar('0') .and. char_code <= iachar('9')) then
                encoded_text = trim(encoded_text) // achar(modd(char_code - iachar('0') + shift, 10) + iachar('0'))
            else
                encoded_text = trim(encoded_text) // text(i:i)
            end if
        end do
    end function caesar_encode
    
    function modd(num, sh) result(ans)
    	INTEGER(KIND=16) :: num
    	INTEGER(KIND=4) :: sh
    	
    	INTEGER(KIND=4) :: ans
    	
    	ans = mod(num, sh)
    	IF (ans < 0) THEN
    		ans = ans + sh
    	END IF
    	
    end function modd

    function encode(string, key) result(ans)
        character(len=*), intent(in) :: string
        INTEGER(KIND=16) :: key
        character(len=100) :: ans
        character(len=100) :: s
        INTEGER(KIND=16) :: i, el
        character(len=1) :: actions(3)
        INTEGER(KIND=16) :: current_key

        actions(1) = '-'
        actions(2) = '*'
        actions(3) = '+'
        s = to_hex(string)  ! Convert string to hexadecimal
        current_key = 0
        ans = ""

        do i = 1, len_trim(s)
            el = iachar(s(i:i))
            current_key = eval_key(current_key, actions(mod(i-1, 3)+1), el)
            ans = trim(ans) // caesar_encode(s(i:i), current_key)
        end do
        key = current_key  ! Update the key with the final value
    end function encode

    function to_hex(string) result(hex_string)
        character(len=*), intent(in) :: string
        character(len=100) :: hex_string
        INTEGER(KIND=16) :: i

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
        INTEGER(KIND=16), intent(in) :: current_key, value
        character(len=1), intent(in) :: action
        INTEGER(KIND=16) :: new_key

        select case (action)
        case ('-')
            new_key = current_key - value
        case ('*')
            new_key = current_key * value
        case ('+')
            new_key = current_key + value
        end select
    end function eval_key

end program caesar_cipher
