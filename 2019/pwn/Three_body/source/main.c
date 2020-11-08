//gcc main.c -o main -fPIE -pie -Wl,-z,relro,-z,now 
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
char *list[0x3];
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
	for(i=0;i<3;i++)
	{
		if(!list[i])
			break;
	}
	if(i==3)
		exit(1);
	unsigned int l=0;
	puts("lenth of Not3>");
	scanf("%u",&l);
	if(l<0x300)
	{
	list[i]=malloc(l);
	if(list[i]){
		puts("Note>");
		read(0,list[i],l);
		}
	else exit(1);
	}
}
void del()
{
	unsigned int i=0;
	puts("Which note?");
	printf(">");
	scanf("%u",&i);
	if(i<0x3&&list[i])
{	free(list[i]);
	list[i]=0;
}
}
void show()
{
	unsigned int i=0;
	puts("Which note?");
	printf(">");
	scanf("%u",&i);
	if(list[i]&&i<0x3)
		puts(list[i]);
}
void edit()
{
	unsigned int i=0;
	puts("Which note?");
	printf(">");
	scanf("%u",&i);
	if(list[i]&&i<0x3)
	{
		unsigned int l=0;
		l=strlen(list[i]);
		printf(">");
		read(0,list[i],l);
	}
}
void menu()
{
	puts("");
	puts("=====================");
	puts("1.add");
	puts("2.del");
	puts("3.show");
	puts("4.edit");
	puts("=====================");
	puts(">");
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
	case 4:
		edit();
		break;
	default:
		exit(0x132);
	}
	}	
}






