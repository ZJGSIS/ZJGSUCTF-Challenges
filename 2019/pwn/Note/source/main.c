//gcc main.c -o main -fPIE -pie -Wl,-z,relro,-z,now -fstack-protector
#include<stdio.h>
#include<stdlib.h>
char *list[0x20];
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
void add()
{
	unsigned int i=0;
	for(i=0;i<0x20;i++)
	{
		if(!list[i])
			break;
	}
	if(i==0x20)
		exit(1);
	list[i]=malloc(0x132);
	if(list[i]){
		puts("Note>");
		read(0,list[i],0x132);
	}
}
void del()
{
	unsigned int i=0;
	puts("Which note?");
	printf(">");
	scanf("%u",&i);
	free(list[i]);
}
void show()
{
	unsigned int i=0;
	puts("Which note?");
	printf(">");
	scanf("%u",&i);
	puts(list[i]);
}
void menu()
{
	puts("");
	puts("=====================");
	puts("1.add");
	puts("2.del");
	puts("3.show");
	puts("=====================");
	puts("");
}
int main()
{
	logo();
	unsigned int cmd; 
	while(1)
	{
	menu();
	scanf("%u",&cmd);
	switch (cmd){
	case 1:
		add();
		break;
	case 2:
		del();
		break;
	case 3:
		show();
		break;
	default:
		exit(0x132);
	}
	}	
}






