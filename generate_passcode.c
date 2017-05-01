// C program to generate 4-digit random no. to be used as "PASSCODE"
// Package com.bhumca2017.eventuate

#include<stdlib.h>
#include<time.h>
#include<stdio.h>

#define MAX 10000
#define N 4

int main()
{
    int rndnum, num, i;
    char strnum[N+1];     // stores string equivalent of the 4-digit number

    unsigned int seedval;
    time_t t;       // t is a time typed variable

    // time(&t) initializes time variable t with system time
    seedval=(unsigned)time(&t);
    srand(seedval); // seed the random no. generator

    rndnum=rand()%(10*N);
    num=rndnum;

    // converting num to string
    for(i=N-1; i>=0; i--)
    {
        int digit=num%10;
        num/=10;

        strnum[i]=(char)(digit+((int)'0'));
    }
    strnum[N]='\0';

    // writing the number string to a data file
    FILE *fptr;
    fptr=fopen("passcode.txt", "w");
    fputs(strnum, fptr);
    close(fptr);

    return 0;
}
