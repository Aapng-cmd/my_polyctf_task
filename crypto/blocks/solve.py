import numpy as np


def decode_matrix(matrix_a, matrix_c):
    res = [[0 for _ in range(len(matrix_a))] for _ in range(len(matrix_a[0]))]
    
    for i in range(len(matrix_a[0])):
        for j in range(len(matrix_a)):
            res[i][j] = matrix_c[j][i] // matrix_a[j][i]
    
    return res

matrix_c = [[903, 1802, 2907, 3716, 4645, 5826, 6426, 7432, 8361, 9500, 10219, 11388, 12662, 14238], [11925, 13296, 15657, 14670, 15314, 17480, 18207, 19272, 19067, 21528, 21875, 21710, 24840, 24920], [27318, 28710, 30070, 29376, 31977, 33116, 31745, 35100, 35890, 34656, 38025, 36200, 39811, 40908], [35819, 38412, 40140, 39974, 41689, 43392, 39053, 44850, 45492, 44928, 47541, 46278, 48070, 50736]]


matrix_a = []
tmp = []
for i in range(len(matrix_c) * len(matrix_c[0])):
    tmp.append(i + 1)
    if (i + 1) % len(matrix_c[0]) == 0:
        matrix_a.append(tmp)
        tmp = []

matrix = decode_matrix(matrix_a, matrix_c)
print(matrix)

ans = []

key = sum([ord(i) for i in "zxcvqwert"])

for block in matrix:
    x0 = block[0]
    x1 = block[1]
    x2 = block[2]
    x3 = block[3]

    d = x0 ^ key
    c = (x1 ^ key) - d
    a = x2 ^ key
    b = (x3 ^ key) - a
    ans.append(chr(a))
    ans.append(chr(b))
    ans.append(chr(c))
    ans.append(chr(d))

print("".join(ans))
