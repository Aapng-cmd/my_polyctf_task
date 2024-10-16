from pwn import *
import time

r = remote("127.0.0.1", 37004)

def bitw(st, shift):
    ans = ""
    shift = int(shift) % 8
    for el in st:
        el = format(ord(el), '08b')
        ans += chr(int(el[shift:] + el[:shift], 2))
        
    return ans

check = ["0"] * 10
checker = checke = 0
times = []
while True:
    data = r.recvuntil(b"/ 100").decode()
    r.recv(1024)
    print(data)
    t1 = time.time()
    r.send(("".join(check) + "\n").encode())
    print(check)
    try:
        feedback = r.recvuntil("Мимо".encode()).decode()
    except EOFError:
        g = r.recv(1024).decode()
        print(g)
        flag = g.split()[5]
        break
    # print(r.recv(1024).decode())
    if "Мимо" in feedback:
        check[checker] = str(int(check[checker]) + 1)
        checke += 1
    print(feedback)
    t2 = time.time()
    print("TIME: ", t2 - t1)
    times.append(t2 - t1)
    if checke == 10:
        check[checker] = str(times.index(max(times)))
        times = []
        checker += 1
        checke = 0
    

r.close()

print(flag)
print(len(flag))
tmp = 0
s = ""
for i in range(0, len(flag), 3):
    s += bitw(flag[i:i+3], check[tmp])
    tmp += 1
print(s, len(s))
