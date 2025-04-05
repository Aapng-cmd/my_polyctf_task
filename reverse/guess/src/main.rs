use std::io;
use rand::Rng;

static mut _IMPORT: u8 = 0;

fn log_reg(name: &str, password: &str) -> bool {
    let name = name.trim();
    let password = password.trim();

    let mut flag = false;
    let mut xor_result = 129;

    if password.len() == ((1 << 4) - 1) {
        for c in password.chars() {
            xor_result = c as u8 ^ xor_result;
        }
    }

    // L6cAEIyrNgZacq1
    if xor_result == 239 {
        flag = true;
    }

    if name == "admin" && flag {
        return true;
    }

    return false;
}

fn gamble(salt: &str) -> bool
{
    let mut creds = 300;
    println!("Try to do from 300 3000");
    println!("You can bet from 1 to your sum. Double or nothing.");
    
    let mut rng = rand::thread_rng();
    let mut mystery: i32 = rng.gen_range(1..=100);
    
    let mut tmp = String::new();
    
    let mut choice: i32;
    let mut bet: i32;
    
    while creds < 3000 && creds > 0
    {
        println!("You now have {}", creds);
        println!("Bet >> ");
        
        tmp.clear();
        
        io::stdin()
            .read_line(&mut tmp)
            .expect("Failed to read line");
        
        bet = tmp.trim().parse().expect("Please enter a valid integer");
        
        if bet < 1 || bet > creds
        {
            println!("Nah, you cannot be seriious");
            continue;
        }
        
        tmp.clear();
        
        creds -= bet;
        println!("Now you have to choose >> ");
        io::stdin()
            .read_line(&mut tmp)
            .expect("Failed to read line");
        
        choice = tmp.trim().parse().expect("Please enter a valid integer");
        
        if choice < 1 || choice > 100
        {
            println!("Wrong choice! Guess between 1 and 100");
            continue;
        }
        
        if choice == mystery
        {
            creds += bet * 2;
            println!("You are right!");
            mystery = rng.gen_range(1..=100);
        }
        else
        {
            println!("Sorry, you failed.");
            for c in salt.chars()
            {
                mystery = (((mystery ^ (c as i32)) | choice) * bet) % 100;
            }
            // println!("PSSS: {}", mystery);
            println!("Do not be sad, here i give you one of digits: {}", mystery % 10);
        }
        
        println!("Now a new one.");
        
    }
    
    if creds >= 3000
    {
        unsafe {
            _IMPORT = '&' as u8;
        }
        return true;
    }
    else
    {
        return false;
    }
    
}

fn simple_hash(input: &str) -> char {
    // Calculate the sum of ASCII values of the characters in the input
    let sum: u32 = input.chars().map(|c| c as u32).sum();
    
    // Map the sum to a value between 0 and 64 (for 'a'-'z', 'A'-'Z', '0'-'9', '{', '_', '}')
    let index = sum % 65;

    match index {
        0..=25 => (b'a' + index as u8) as char,          // 'a' to 'z'
        26..=51 => (b'A' + (index - 26) as u8) as char, // 'A' to 'Z'
        52..=61 => (b'0' + (index - 52) as u8) as char, // '0' to '9'
        62 => '{',                                       // '{'
        63 => '_',      
        64 => '}',                                       // '}'
        _ => unreachable!(),                             // This should never happen
    }
}

fn handle_error()
{
    unsafe {
        let mut _import = _IMPORT;
        // println!("FLAG STATUS CHECK {}", _import);
        if _import != '&' as u8
        {
            return;
        }
    }
    
    let mut flag = String::new();
    
    flag.push(simple_hash("dmuspU1CLHEYPE7"));
    flag.push(simple_hash("cp1ePdGYc0qwcVhc2ua5dNwHOj18H"));
    flag.push(simple_hash("K_bh9n{xfQ3ifp2KMSMV"));
    flag.push(simple_hash("oEpU3jEQnS3SOdZYRaPUhBg"));
    flag.push(simple_hash("fFlQiQxJ3KIsxrgg56uT3j_7"));
    flag.push(simple_hash("yux8xNfKg6KxLZasEkdwXxsAy90A2"));
    flag.push(simple_hash("OSF8XOSgfuhY}5cV"));
    flag.push(simple_hash("Mw72D80RgNtW2AXHW3WbYVUnAE9m"));
    flag.push(simple_hash("dKzBQh2MxeIkkO7"));
    flag.push(simple_hash("2q8qXPKeX2NpKsvKBBml"));
    flag.push(simple_hash("zFMhuoOLCqiH_T"));
    flag.push(simple_hash("aEric6J_WruoTCniLTEvr}3"));
    flag.push(simple_hash("6}E4tXGH68trt"));
    flag.push(simple_hash("n2sOkbig3Ufwn6"));
    flag.push(simple_hash("tyq3JjQYv7Sm3qhOcNeBTbacxT5RS2"));
    flag.push(simple_hash("WO2jehDOBraT22WuFIQ5JpQ"));
    flag.push(simple_hash("55ISE{6WG6w6B7SrMHM"));
    flag.push(simple_hash("rO4Bj8ZVTddS8GS"));
    flag.push(simple_hash("hsccfp6f{MlzSbQUvp3ZynCNHZIOz"));
    flag.push(simple_hash("l10JgV}1U9iFNpk2stxVLW0HH3Z"));
    flag.push(simple_hash("NSN1uA3lJ6{x7LsHzYGc2laGt5O"));
    flag.push(simple_hash("PQTeBw_hl5Cww5KSPRSGKBwhgV4YYX"));
    flag.push(simple_hash("5WzfQetGlXVXPh"));
    flag.push(simple_hash("Cs0xfE6k4gG"));
    flag.push(simple_hash("PuuSn9rv5LH5XOYhW69{mA"));
    flag.push(simple_hash("M3gU1fnNZTqBLeY"));
    flag.push(simple_hash("GQe2fR6y8"));
    flag.push(simple_hash("Hiva{4RF{37QmFApd"));
    flag.push(simple_hash("2al75mGfTaGt{FaO"));
    flag.push(simple_hash("Cr0calVQO71XVKC7ameBQn259rs}"));
    flag.push(simple_hash("rFyG8jCUnh_cvOfwRaUc"));
    flag.push(simple_hash("eWz9KGWEwhJ"));
    flag.push(simple_hash("VGvWXr8cMJPR_x08MyCW"));
    flag.push(simple_hash("9ny8KPAByDlWYwgfNAdu9mxst"));
    flag.push(simple_hash("BIdqWLwzguPIyx4llI67H8"));
    flag.push(simple_hash("L2L3vh4Ct"));
    flag.push(simple_hash("Jkw0A8BhNNYJ9nP3xRTN0BDfndt"));
    flag.push(simple_hash("nAfPyYeQw2xasm"));
    flag.push(simple_hash("O7heULqFRM3miRCwpTXG0zg5FWDM8w"));
    flag.push(simple_hash("bC50mZJte9U"));
    flag.push(simple_hash("}rehk2WoSRlKFydi2r9PjxE"));
    flag.push(simple_hash("6ErO_WI4b9"));
    flag.push(simple_hash("RhQ2ZONS3sU"));
    flag.push(simple_hash("WaDJTbfbx_moT"));
    flag.push(simple_hash("WCeHADyzp88B35xVOo"));
    flag.push(simple_hash("kPdVxOzWdidezJ3a_uwtqCdjpOAf"));
    flag.push(simple_hash("c1peFtXvX9Kz2fGc2HqPzW"));
    flag.push(simple_hash("g13Ftkxwa}8A8TELMsmcYQ0"));
    flag.push(simple_hash("FrMvEUu_uVR"));
    flag.push(simple_hash("k8dALqk8FPnQkEJs2hhPaLzIDpqTyJ"));
    
    println!("{}", flag);
}

fn main() {
    let mut name = String::new();
    let mut password = String::new();

    println!("Please enter your name:");
    io::stdin()
        .read_line(&mut name)
        .expect("Failed to read line");

    println!("Please enter your password:");
    io::stdin()
        .read_line(&mut password)
        .expect("Failed to read line");
    
    
    if log_reg(&name, &password)
    {
        if gamble(&password)
        {
            handle_error();
        }
    }
    else
    {
        println!("Game over!");
    }
}
