#include <time.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
    printf("Here is a prototype of our noting service. Try it by yourself!\n");
    time_t start_time;
    time(&start_time);

    char * username = 0;
    char * password = 0;

    int flag = 0;

    while(1)
    {
        
        if(username){
            printf("Username: %s\n", username);
        }
        if(password){
            printf("Password: %s\n", password);
        }

        printf("1: Username\n");
        printf("2: Password\n");
        printf("3: Reset\n");
        printf("4: Login\n");
        printf("5: Exit\n");
        printf("Choose an option [1-5]: ");

        int choice = 0;
        scanf("%d", &choice);

        switch(choice)
        {
            case 1:
                username = malloc(20*sizeof(char));
                printf("Enter username: ");
                scanf("%254s", username);

                if(!strcmp(username, "root"))
                {
                    printf("[root]: Ain't no way it's that easy. Try again fool!\n");
                    strcpy(username, "");
                }

                break;

            case 2:
                if (!username){
                    printf("What tf are you setting a password for? Set a username first fool\n");
                    break;
                }

                password = malloc(20*sizeof(char));
                printf("Enter password: ");
                scanf("%254s", password);
                printf("Bruh! My grandmother is stronger than that password!\n");

                break;

            case 3:
                if (!password && !username){
                    printf("Do you want me to reset yo ass? Use your brains man!\n");
                    printf("How tf you gonna reset smth that don't exist!\n");
                    break;
                }

                free(password);
                free(username);

                break;

            case 4:
                if (!password || !username){
                    printf("How tf you gonna log in without both credentials [username & password] dumbass! Set them up first\n");
                    break;
                }

                char * temp_uname = (char*)malloc(20*sizeof(char));
                char * temp_pwd = (char*)malloc(20*sizeof(char));

                printf("Enter username: ");
                scanf("%254s", temp_uname);

                printf("Enter password: ");
                scanf("%254s", temp_pwd);

                if(!strcmp(username, "root"))
                {
                    time_t end_time;
                    time(&end_time);

                    double time_spent = difftime(end_time, start_time);
                    printf("You took %.2f seconds to find vulnerability...\n", time_spent);

                    flag = 1;

                    char * command = (char*)malloc(20*sizeof(char));
                    printf("Nicely done! Here is your command: \n");
                    scanf("%254s", command);

                    system(command);

                    free(command);

                    exit(0);
                }

                if(!strcmp(temp_uname, username) && !strcmp(temp_pwd, password)){
                    printf("Logged in successfully but DID NOT drop a shell!\n");
                }
                else{
                    printf("Incorrect username or password! Try again dumbass!\n");
                }

                free(temp_pwd);
                free(temp_uname);

                break;

            case 5:
                exit(0);

            default:
                printf("Invalid Option! Try Again!\n");
                break;
        }
    }
}
