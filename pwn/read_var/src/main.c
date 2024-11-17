#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>



int main() {
	char buffer[40] = "flag_plug";
	// char buffer[40] = "flag_plug";
	
/*	printf("%p\n", &buffer);*/
/*	fflush(stdout);*/
	
	printf("Prompt >> \n");
	fflush(stdout);
	scanf("%s", &buffer);
	
	printf(buffer);
	fflush(stdout);
	
	// read(0, buffer, 500);
	// free(buffer);
}
