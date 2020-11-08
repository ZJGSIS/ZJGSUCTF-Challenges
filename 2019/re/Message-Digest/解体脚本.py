import hashlib
fg="6941162AC29D59EBC6C3737D296359B2"
fg=fg.lower()
for i in range(0,999999):
    m=hashlib.md5()
    strs=str(i)+"re200"
    a=strs.encode(encoding="utf-8")
    m.update(a)
    t_md5=m.hexdigest()
    if t_md5==fg:
        print(i)
