from random import randint


FLAG = "flag_plug"

def get_random(array):
    i = randint(0, len(array) - 1)
    return array.pop(i), array


def game(points, round):
    DIFFICULTY = 10 + round
    loot = [i + 1 for i in range(DIFFICULTY)]
    while points > 0 and len(loot) > 0:
        index = int(input())
#        if index not in loot:
#            print("Атата")
#            return 0
        
        x, loot = get_random(loot)
        
        if index == x:
            return points * DIFFICULTY
        else:
            print("Не угадал, ещё разочек. Теперь другое число.")
            points -= points // DIFFICULTY
    print("Ну ты лошара")
    return 0

Q = 100

POINTS = 3000

print("Старая игра угадай число!")

for round in range(Q):
    print("Сделай ставку, сейчас у тебя", POINTS)
    points = int(input())
    while points > POINTS:
        print("Губа не дура. Но давай ка ещё раз попытайся")
        points = int(input())
    
    POINTS -= points
    print(f"Игра на {points} очков")
    p = game(points, round)
    POINTS += p // 6
    
    if POINTS <= 0:
        print("Вас выгнали из-за долгов")
        exit()

print(FLAG)
