#include <jni.h>
#include <string>
#include <cstring>
#include <malloc.h>

int encrypt(const unsigned char *Key, unsigned char *Data, int BlockCount)
{
    unsigned int y, z, sum, i, j;
    unsigned int delta = 0x9e3779b9;  /* a key schedule constant */
    unsigned int a, b, c, d;   /* cache key */

    a = (unsigned int)((Key[0] << 24) | (Key[1] << 16) | (Key[2] << 8) | Key[3]);
    b = (unsigned int)((Key[4] << 24) | (Key[5] << 16) | (Key[6] << 8) | Key[7]);
    c = (unsigned int)((Key[8] << 24) | (Key[9] << 16) | (Key[10] << 8) | Key[11]);
    d = (unsigned int)((Key[12] << 24) | (Key[13] << 16) | (Key[14] << 8) | Key[15]);

    for (i = 0; i < BlockCount; i++)
    {
        sum = 0;
        y = (unsigned int)((Data[i * 8 + 0] << 24) | (Data[i * 8 + 1] << 16) | (Data[i * 8 + 2] << 8) | Data[i * 8 + 3]);
        z = (unsigned int)((Data[i * 8 + 4] << 24) | (Data[i * 8 + 5] << 16) | (Data[i * 8 + 6] << 8) | Data[i * 8 + 7]);

        for (j = 0; j < 32; j++)
        {
            sum += delta;
            y += ((z << 4) + a) ^ (z + sum) ^ ((z >> 5) + b);
            z += ((y << 4) + c) ^ (y + sum) ^ ((y >> 5) + d);
        }

        Data[i * 8 + 0] = (unsigned char)((y >> 24) & 0xFF);
        Data[i * 8 + 1] = (unsigned char)((y >> 16) & 0xFF);
        Data[i * 8 + 2] = (unsigned char)((y >> 8) & 0xFF);
        Data[i * 8 + 3] = (unsigned char)((y >> 0) & 0xFF);

        Data[i * 8 + 4] = (unsigned char)((z >> 24) & 0xFF);
        Data[i * 8 + 5] = (unsigned char)((z >> 16) & 0xFF);
        Data[i * 8 + 6] = (unsigned char)((z >> 8) & 0xFF);
        Data[i * 8 + 7] = (unsigned char)((z >> 0) & 0xFF);

    }
    return 0;

}
extern "C" JNIEXPORT jstring JNICALL
Java_ctf_huawei_coffee_MainActivity_getResult(
        JNIEnv *env,
        jobject instance,
        jbyteArray pass
) {

    jsize len=env->GetArrayLength(pass);
    jbyte *jbarry=(jbyte*)malloc(len*sizeof(jbyte));
    env->GetByteArrayRegion(pass,0,16,jbarry);

    unsigned char *flag=(unsigned char *)jbarry;
    if(len!=16)
    {
        return env->NewStringUTF("WRONG!\n");
    }
    *(flag+16)=0;
    const unsigned char key[16] = { 0x00,0x01,0x03,0x04,0x05,0x06,0x07,0x08,0x09,0x0a,0x0b,0x0c,0x0d,0xe,0xf,0x00 };
    unsigned char fg[] = { 0xab,0x7d,0x9a,0xf9,0x72,0x86,0x55,0xf6,0x8f,0xbc,0x39,0x58,0x28,0x88,0xd8,0x09 };
    unsigned char buf[16];
    memcpy(buf,flag,16);
    encrypt(key,buf,2);
    int f = 0;
    for (int i = 0; i < 16; i++)
    {
        if (fg[i] != buf[i])
        {
            f = 1;
            break;
        }
    }
    if (f == 1)
        return env->NewStringUTF("WRONG!!\n");


    unsigned char unflag[28] = {60,38,38,52,46,15,49,50,110,32,115,43,52,60,32,74,32,83,79,77,69,32,84,69,65,33,125,0 };
    for(int i=0;i<16;i++)
    {
        unflag[i]^=*(flag+i);
    }
    printf("%s",unflag);
    return env->NewStringUTF("YOU ARE RIGHT!\n");


}
