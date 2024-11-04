#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>



int main() {
	char buffer[40] = "PolyCTF{gather_internal_variable}";
	// char buffer[40] = "PolyCTF{gather_internal_variable}";
	
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
