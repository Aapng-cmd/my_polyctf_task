import secrets


def create_matrix(rows, cols):
    return [[1 + rows * _ + __ for __ in range(rows)] for _ in range(cols)]

def code_matrices(matrix_a, matrix_b):
    """Multiplies two matrices if they are compatible."""
    if len(matrix_a[0]) != len(matrix_b):
        raise ValueError("Incompatible matrices for multiplication.")
    
    # Create a result matrix initialized with zeros
    result = [[0 for _ in range(len(matrix_a[0]))] for _ in range(len(matrix_a))]
    
    # Perform multiplication
    for i in range(len(matrix_a)):
        for j in range(len(matrix_b)):
            result[i][j] = matrix_a[i][j] * matrix_b[j][i]
    
    return result


FLAG = b"flag_plug"
FLAG += secrets.token_bytes(4 - len(FLAG) % 4)

blocks = []

for i in range(0, len(FLAG), 4):
    blocks.append(FLAG[i:i+4])


key = sum([ord(i) for i in input()])


print(blocks)

for i, block in enumerate(blocks):
    print(block)
    blocks[i] = [int(block[3]) ^ key, int(block[3]) + int(block[2]) ^ key, int(block[0]) ^ key, int(block[0]) + int(block[1]) ^ key]

matrix = create_matrix(len(blocks), 4)
print(matrix)
print(blocks)

print(cipher := code_matrices(matrix, blocks))
with open("task.txt", "w") as f: f.write(f"{cipher = }")
