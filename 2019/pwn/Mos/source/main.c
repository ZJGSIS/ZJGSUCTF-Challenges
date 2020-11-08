//gcc main.c -o main -fno-stack-protector -z execstack
#include<stdio.h>
int main()
{
	char buf[0x10];
	printf("Magic Adress ===>>>%p",buf);
	read(0,buf,0x400);
}
