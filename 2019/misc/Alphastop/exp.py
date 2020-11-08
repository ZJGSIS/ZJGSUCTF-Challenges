from pwn import *
def ps(pos=""):
	p.readuntil("Time remain:")
	p.readline()
	p.readline()
	p.sendline(pos)
def fill(c="A"):
	for x in range(1,20):
		ps(c+str(x))
def F(c="A"):
	for x in range(1,20):
		if x not in [8,9,10,11,12]:
			ps(c+str(x))
p=remote("10.21.13.190",2604)


ps("J11")
ps("I11")
ps("I10")
ps("I9")
ps("J8")
ps("K8")
ps("L9")
ps("L10")
ps("L11")
ps("K12")
#
for x in ['R','S','Q','P','O','N','M',]:
	fill(x)

F("K")
F("L")
for x in range(13,20):
	ps("J"+str(x))
ps("L12")
ps("L8")
ps("K9")
context.log_level='debug'
ps("K10")
#gdb.attach(p)
p.interactive()
