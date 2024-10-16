#!/usr/bin/python3
import random
import operator
import hashlib
from tabulate import tabulate

global EQ
EQ = 0
FLAG = "PolyCTF{eas4_c4l3_13_m1n3_b3s9!}"


def create_table(multi_expr):
    return tabulate(multi_expr, tablefmt="grid")


def build_matrix(expression):
    multi_expr = []
    multi_expr_tmp = []
    direct = "r"
    pos = 0
    _ = random.randint(3, 10)
    for el in expression.split():
        if pos < 0:
            _ = random.randint(3, 10)
            direct = "d"
            pos = 0
            multi_expr.append(multi_expr_tmp)
            multi_expr_tmp = [""]
        if _ == 0:
            _ = random.randint(3, 10)
            if direct == "d" and pos > 0:
                direct = random.choice(["r", "l"])
            elif direct == "d":
                direct = "r"
            else:
                if direct == "r": pos -= 1
                else: pos += 1
                direct = "d"

            
            multi_expr.append(multi_expr_tmp)
            if direct == "r": multi_expr_tmp = [""] * (pos)
            else:  multi_expr_tmp = [""] * (pos + 1)
            
            
        
        if direct == "r":
            multi_expr_tmp.append(el)
            pos += 1
        elif direct == "d":
            multi_expr.append(multi_expr_tmp)
            multi_expr_tmp = [""] * (pos + 1)
            multi_expr_tmp[pos] = el

            
        elif direct == "l":
            multi_expr_tmp[pos] = el
            pos -= 1
        
        _ -= 1
    
    multi_expr.append(multi_expr_tmp)
    return multi_expr


def generate_expression(max_num=1000):
    num_operands = random.randint(10, 40) + EQ
    expression = ""
    for i in range(num_operands):
        num = random.randint(1, max_num)
        expression += str(num)
        if i < num_operands - 1:
            op = random.choice([operator.add, operator.sub, operator.mul, operator.truediv])
            expression += " " + {operator.add: "+", operator.sub: "-", operator.mul: "*", operator.truediv: "/"}[op] + " "
    
    return expression, eval(expression)


def create_eq():
    expr, ans = generate_expression()
    return build_matrix(expr), ans

def ctf_task():
    global EQ
    while True:
        print(f"Осталось вычислить {EQ} / 100:\n")
        st, ans = create_eq()
        print(ans)
        st = list(filter(None, st))
        st = [sublist for sublist in st if any(x != '' for x in sublist)]
        st = create_table(st)
        print((st + "\n"))
        cl_ans = input()
        if str(cl_ans).strip() == str(ans).strip():
            EQ += 1
            print("Верно!\n")
        else:
            print(f"Неверно! Правильный ответ: {ans}\n")
        
        if EQ == 100:
            print("Молодец! Вот флаг.\n")
            for i in range(0, len(FLAG), 2):
                print(hashlib.sha256(FLAG[i:i+2].encode()).hexdigest() + "\n")
            break

if __name__ == '__main__':
    ctf_task()
