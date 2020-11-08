# Pwn

第一次为比赛出题.
本次比赛`Mos`,`Time`自我感觉质量不错.其他感觉体现了我渣渣的出题水平.

## Mos

很简单的题但是加上了一些吸引注意力的东西假装 leak.

## Time

`comb one_gadget & fmt & got hijacking`

## Note

第三题本来相出 2.29 下的 double-free 但是被`starctf:fgirlfriend`抢先了.结果忙着国赛出题就没怎么管最后随便上了个醉醉简单的`double free+ tcache`..质量很差的一题

## Crash

第四题涉及`IO_leak`测试的时候`partial`2 字节.
然后上环境之后发现概率是`1/65536`
虽然我开着 16 个`terminal`跑出来`flag`了但是感觉这个概率还是有点坑(比较忙没去多看有没有增大概率的机会)

## Three-body

`off-by-one` 没什么创新,简单的`shrink`.
