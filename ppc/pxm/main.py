#!/usr/bin/python3
import pickle
import random
from prettytable import PrettyTable
from ast import literal_eval
from base64 import b64encode


FLAG = "flag_plug"

ALL = 150
Q = ALL // 3 * 2


def create_matrix():
    """Creates a matrix with random dimensions (rows and columns) filled with random integers."""
    rows = random.randint(4, 9)  # Random number of rows between 2 and 5
    cols = random.randint(4, 9)  # Random number of columns between 2 and 5
    return [[random.randint(-30 - i, 30 + i) for _ in range(cols)] for _ in range(rows)], [[random.randint(1, 10) for _ in range(rows)] for _ in range(cols)]

def print_matrix(matrix):
    """Prints the matrix using PrettyTable."""
    table = PrettyTable()
    table.title = ""
    for row in matrix:
        table.add_row(row)
    return table.get_string()

def print_expr(matrix1, matrix2):
    """Prints two matrices side by side, ensuring spaces for empty rows."""
    max_rows = max(len(matrix1), len(matrix2))  # Get the maximum number of rows
    table = PrettyTable()
    table.field_names = ["Matrix 1", "Matrix 2"]
    
    for i in range(max_rows):
        row1 = matrix1[i] if i < len(matrix1) else []
        row2 = matrix2[i] if i < len(matrix2) else []
        
        # Prepare the row strings for the table
        formatted_row1 = f"({', '.join(map(str, row1))})" if row1 else "    "
        formatted_row2 = f"({', '.join(map(str, row2))})" if row2 else "    "
        
        # Add the rows to the table
        table.add_row([formatted_row1, formatted_row2])
    
    return table.get_string()

def multiply_matrices(matrix_a, matrix_b):
    """Multiplies two matrices if they are compatible."""
    if len(matrix_a[0]) != len(matrix_b):
        raise ValueError("Incompatible matrices for multiplication.")
    
    # Create a result matrix initialized with zeros
    result = [[0 for _ in range(len(matrix_b[0]))] for _ in range(len(matrix_a))]
    
    # Perform multiplication
    for i in range(len(matrix_a)):
        for j in range(len(matrix_b[0])):
            for k in range(len(matrix_b)):
                result[i][j] += matrix_a[i][k] * matrix_b[k][j]
    
    return result


i = 0
print("Умножай матрицы!")
while i != ALL:
    if i == Q:
        print("Ещё немного, давай!")
        Q = ALL
    
    print(f"Осталось {i} / {Q}")
    matrix, multiplier = create_matrix()
    
    expresion = print_expr(matrix, multiplier)
    
    res = multiply_matrices(matrix, multiplier)
    
    print(res)
    
    # print(print_matrix(matrix) + " ; " + print_matrix(multiplier))
    print(str(pickle.dumps(b64encode(print_matrix(matrix).encode()).decode() + " ; " + b64encode(print_matrix(multiplier).encode()).decode())))

    try:
        ans = literal_eval(input())
    except ValueError:
        print("Either you try to cheat, or you did smth wrong. Anyway, lets do from start")
        i = 0
    
    if isinstance(ans, list):
        if res == ans:
            i += 1
            print(str(b"Mo^08eC"))


print(FLAG)
    
