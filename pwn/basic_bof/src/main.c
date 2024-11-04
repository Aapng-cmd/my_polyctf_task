#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>



int main() {
	char buffer[80];
	// char b[80];
	printf("Here is a present for you\n");
	fflush(stdout);
	
	// printf("%lx\n", &buffer);
	
	printf("%p\n", &buffer);
	fflush(stdout);
	
	// printf("Prompt >> \n");
	// fflush(stdout);
	// scanf("%s", &buffer);
	
	// printf(buffer);
	// fflush(stdout);
	
	read(0, buffer, 500);
	// free(buffer);
}
