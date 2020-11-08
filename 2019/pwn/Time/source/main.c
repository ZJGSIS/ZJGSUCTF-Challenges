//gcc main.c -o main
#include<stdio.h>
#include<time.h>
#include<stdlib.h>
time_t t=0;
void logo()
{
	alarm(0x60);
	setvbuf(stdin,0,2,0);
	setvbuf(stdout,0,2,0);
	setvbuf(stderr,0,2,0);
	puts("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
	puts("       ____________  ________   ");
	puts("  ____/_   \\_____  \\ \\_____  \\  ");
	puts(" /    \\|   | _(__  <  /  ____/  ");
	puts("|___|  /___/______  /\\_______ \\ ");
	puts("     \\/           \\/         \\/ ");
	puts("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
	puts("");
	return;
}
int leave(char *a)
{
	puts(a);
	return 0;	
}
void vul()
{
	char buf[0x40];
	puts("");
	puts("");
	printf("+TimeKeeper+\n");
	printf("%d hour(s) went by....\n",t);
	read(0,buf,t+0x10);
	printf(buf);
	puts("");
	if(t>2)
	{
		leave("Tip lost.");
		system("echo TRY#TO#CAT#THE#TIP");
	}
	if(t>23)
	{
		leave("Crul lost.");
		system("rm -rf ./crul");
	}
}	
int main()
{
	t=(time(0)-(1553566663-3600*3))/3600;//kuohaonei shi kaishishijian
	system("echo THKdavid942j");
	logo();
	vul();	
}
