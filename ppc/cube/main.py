#!/usr/local/bin/python
import magiccube
from random import randint as ri


FLAG = "flag_plug"

Q = 100

print(f"Реши кубик-рубика {Q} раз")
print("""
примеры ввода:
L - левая часть по часовой
L' - против часовой
2B - вторая задняя часть по часовой
3F2 - третья передняя часть дважды по часовой
""")

for step in range(Q):
    cube = magiccube.Cube(ri(2, 15))
    print(cube)
    
    print("Вот так он должен выглядеть")
    # move = str(list(cube.generate_random_moves())[0])
    move = cube.generate_random_moves()
    # print(move)
    cube.rotate(move)
    # cube.rotate()

    print(cube)
    while not cube.is_done():
        m = input(">> ")
        cube.rotate(m)
        print(cube)
    
    print(f"Ай молодца! Осталось {Q - step - 1} решить")


print(FLAG)
