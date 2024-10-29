import pickle, re
from base64 import b64decode


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


def parse_ascii_table(ascii_table):
    table_re_list = re.split(r'\+[+-]+', ascii_table)
    table_list = [l.strip().replace('\n', '') for l in table_re_list if l.strip()]
    table = {'Title': table_list[0].replace('|', '').strip(),
             'Column Names': [ch.strip() for ch in table_list[1].split('|') if ch.strip()],
             'Rows': list()}
    for row in table_list[2:]:
        joined_row = ['' for _ in range(len(row))]
        for lines in [line for line in row.split('||')]:
            line_part = [i.strip() for i in lines.split('|') if i]
            joined_row = [i + j for i, j in zip(joined_row, line_part)]
        table['Rows'].append(joined_row)
    
    array = []
    q = []
    for i, el in enumerate(table['Column Names']):
    	q.append(int(el))
    	if (i + 1) % (len(table['Title'].split()) // 2) == 0:
    		array.append(q)
    		q = []
    
    
    return array


s = b''


matrix1, matrix2 = pickle.loads(s).split(";")

matrix1 = parse_ascii_table(b64decode(matrix1).decode())
matrix2 = parse_ascii_table(b64decode(matrix2).decode())

print(multiply_matrices(matrix1, matrix2))
