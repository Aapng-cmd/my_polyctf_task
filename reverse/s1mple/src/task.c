#include <stdio.h>


struct User
{
    char right[16];
    char left[16];
    char forward[16];
    int final_check;
};

void main()
{
    char *flag = "PolyCTF{8UfF3R_0v3rF10w_w17H_W47cH1N_V4R148135}";
    char right[16];
    char left[16];
    char forward[16];
    struct User user;
    
    user.final_check = 0;
    
    printf("Let's create an avatar");
    fflush(stdout);
    printf("Right direction: ");
    fflush(stdout);
    scanf("%32s", user.right);
    
    printf("Left direction: ");
    fflush(stdout);
    scanf("%32s", user.left);
    
    printf("Forward direction: ");
    fflush(stdout);
    scanf("%200s", user.right);
    
    
    if (user.final_check == 1)
        printf(user.left);
    else
    {
        printf("%s\n", user.right);
        printf("%s\n", user.left);
        printf("%s\n", user.forward);
        printf("%i", user.final_check);
    }
}
