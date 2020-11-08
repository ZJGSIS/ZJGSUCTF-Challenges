#include<string>
#include<iostream>
#include<openssl/md5.h>
#include<string.h>
using namespace std;
string x789101112="6941162AC29D59EBC6C3737D296359B2";
string XXX(const string& src)
{
	MD5_CTX ctx;
	string xxx_string;
	unsigned char xx[16]={0};
	char tmp[33]={0};

	MD5_Init(&ctx);
	MD5_Update(&ctx,src.c_str(),src.size());
	MD5_Final(xx,&ctx);

	for(int i=0;i<16;++i)
	{
		memset(tmp,0x00,sizeof(tmp));
		sprintf(tmp,"%02X",xx[i]);
		xxx_string +=tmp;
	}
	return xxx_string;
}
int main()
{
	string str;
	cout<<"input a number"<<endl;
	getline(cin,str);
	if(str.length()!=6)
	{
		cout<<"try again"<<endl;
		return 0;
	}
	string sstr=str+"re200";
	if(XXX(sstr)==x789101112)
		cout<<"yeah,flag is flag{"<<str<<"}"<<endl;
	else
		cout<<"try again"<<endl;
	
}

