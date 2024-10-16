import os
FLAG = "PolyCTF{Y3s_1t5_trul4_3x35t5} (if y0u w4nt t0 ch3ck https://t.me/glebkomelkov)"
import time

class CryptoProj():
    def __init__(self, key):
        self.key = key
    
    
    def __change_bytes(self, matrix, enecrypt=True):
        S_box = [99, 124, 119, 123, 242, 107, 111, 197, 48, 1, 103, 43, 254, 215, 171, 118, 202, 130, 201, 125, 250, 89, 71,
                 240, 173, 212, 162, 175, 156, 164, 114, 192, 183, 253, 147, 38, 54, 63, 247, 204, 52, 165, 229, 241, 113,
                 216, 49, 21, 4, 199, 35, 195, 24, 150, 5, 154, 7, 18, 128, 226, 235, 39, 178, 117, 9, 131, 44, 26, 27, 110,
                 90, 160, 82, 59, 214, 179, 41, 227, 47, 132, 83, 209, 0, 237, 32, 252, 177, 91, 106, 203, 190, 57, 74, 76,
                 88, 207, 208, 239, 170, 251, 67, 77, 51, 133, 69, 249, 2, 127, 80, 60, 159, 168, 81, 163, 64, 143, 146,
                 157, 56, 245, 188, 182, 218, 33, 16, 255, 243, 210, 205, 12, 19, 236, 95, 151, 68, 23, 196, 167, 126, 61,
                 100, 93, 25, 115, 96, 129, 79, 220, 34, 42, 144, 136, 70, 238, 184, 20, 222, 94, 11, 219, 224, 50, 58, 10,
                 73, 6, 36, 92, 194, 211, 172, 98, 145, 149, 228, 121, 231, 200, 55, 109, 141, 213, 78, 169, 108, 86, 244,
                 234, 101, 122, 174, 8, 186, 120, 37, 46, 28, 166, 180, 198, 232, 221, 116, 31, 75, 189, 139, 138, 112, 62,
                 181, 102, 72, 3, 246, 14, 97, 53, 87, 185, 134, 193, 29, 158, 225, 248, 152, 17, 105, 217, 142, 148, 155,
                 30, 135, 233, 206, 85, 40, 223, 140, 161, 137, 13, 191, 230, 66, 104, 65, 153, 45, 15, 176, 84, 187, 22]
        inverse_S_box = [82, 9, 106, 213, 48, 54, 165, 56, 191, 64, 163, 158, 129, 243, 215, 251, 124, 227, 57, 130, 155,
                         47, 255, 135, 52, 142, 67, 68, 196, 222, 233, 203, 84, 123, 148, 50, 166, 194, 35, 61, 238, 76,
                         149, 11, 66, 250, 195, 78, 8, 46, 161, 102, 40, 217, 36, 178, 118, 91, 162, 73, 109, 139, 209, 37,
                         114, 248, 246, 100, 134, 104, 152, 22, 212, 164, 92, 204, 93, 101, 182, 146, 108, 112, 72, 80, 253,
                         237, 185, 218, 94, 21, 70, 87, 167, 141, 157, 132, 144, 216, 171, 0, 140, 188, 211, 10, 247, 228,
                         88, 5, 184, 179, 69, 6, 208, 44, 30, 143, 202, 63, 15, 2, 193, 175, 189, 3, 1, 19, 138, 107, 58,
                         145, 17, 65, 79, 103, 220, 234, 151, 242, 207, 206, 240, 180, 230, 115, 150, 172, 116, 34, 231,
                         173, 53, 133, 226, 249, 55, 232, 28, 117, 223, 110, 71, 241, 26, 113, 29, 41, 197, 137, 111, 183,
                         98, 14, 170, 24, 190, 27, 252, 86, 62, 75, 198, 210, 121, 32, 154, 219, 192, 254, 120, 205, 90,
                         244, 31, 221, 168, 51, 136, 7, 199, 49, 177, 18, 16, 89, 39, 128, 236, 95, 96, 81, 127, 169, 25,
                         181, 74, 13, 45, 229, 122, 159, 147, 201, 156, 239, 160, 224, 59, 77, 174, 42, 245, 176, 200, 235,
                         187, 60, 131, 83, 153, 97, 23, 43, 4, 126, 186, 119, 214, 38, 225, 105, 20, 99, 85, 33, 12, 125]
        if enecrypt:
            for i in range(4):
                for j in range(4):
                    matrix[i][j] = S_box[matrix[i][j]]
        else:
            for i in range(4):
                for j in range(4):
                    matrix[i][j] = inverse_S_box[matrix[i][j]]
        return matrix
    
    
    def __bytes_to_matrix(self, text):
        """ Converts a 16-byte array into a 4x4 matrix.  """
        return [list(text[i:i + 4]) for i in range(0, len(text), 4)]
    
    
    def __matrix_to_bytes(self, matrix):
        return (sum(matrix, []))
    
    
    def __key_generation(self, key):
        import gostcrypto
    
    
        keys = []
        key = key.encode('cp1251')
        hash_obj = gostcrypto.gosthash.new('streebog256', data=key)
        for i in range(16):
            keys.append(bytes.fromhex(str(hash_obj.hexdigest())))
            hash_obj = gostcrypto.gosthash.new('streebog256', data=keys[i])
        return keys
    
    
    def __XOR(self, matrix, key):
        for i in range(4):
            for j in range(4):
                matrix[i][j] ^= key[i][j]
        return matrix
    
    
    def __razbit(self, new_bytes):
        itog = []
        if len(new_bytes) < 16:
            itog.append(new_bytes + (bytes([0]) * (16 - len(new_bytes))))
            return itog
        else:
            for i in range(0, len(new_bytes), 16):
                if i + 16 < len(new_bytes):
                    itog.append(new_bytes[i:i + 16])
                else:
                    dop = i + 16 - len(new_bytes)
                    itog.append(new_bytes[i:len(new_bytes)] + dop * bytes([0]))
            return ([os.urandom(16)] + itog + [os.urandom(16)])
    
    
    def __razbit_decrypt(self, enecrypted_bytes):
        return [list(enecrypted_bytes[i:i + 16]) for i in range(0, len(enecrypted_bytes), 16)]
    
    
    def __peremeshenie(self, matrix, enc=True):
        if enc:
            matrix[0][0], matrix[0][3] = matrix[0][3], matrix[0][0]
            matrix[0][1], matrix[0][2] = matrix[0][2], matrix[0][1]
        
            matrix[1][0], matrix[1][1] = matrix[1][1], matrix[1][0]
            matrix[1][0], matrix[1][3] = matrix[1][3], matrix[1][0]
        
            matrix[2][0], matrix[2][1] = matrix[2][1], matrix[2][0]
            matrix[2][1], matrix[2][2] = matrix[2][2], matrix[2][1]
        
            matrix[3] = list(reversed(matrix[3]))
        else:
            matrix[0][0], matrix[0][3] = matrix[0][3], matrix[0][0]
            matrix[0][1], matrix[0][2] = matrix[0][2], matrix[0][1]
            
            matrix[1][0], matrix[1][3] = matrix[1][3], matrix[1][0]
            matrix[1][0], matrix[1][1] = matrix[1][1], matrix[1][0]
        
            matrix[2][1], matrix[2][2] = matrix[2][2], matrix[2][1]
            matrix[2][0], matrix[2][1] = matrix[2][1], matrix[2][0]
            
            matrix[3] = list(reversed(matrix[3]))
        return matrix
    
    
    
    def enecrypt_all(self, new_bytes: str) -> bytes:
        import base64
        
        
        new_bytes = self.__razbit(new_bytes.encode("utf-8"))
        enecrypted_bytes = []
        keys = self.__key_generation(self.key)
        for i in range(len(new_bytes)):
            data = new_bytes[i]
            data = self.__bytes_to_matrix(data)
            for j in range(16):
                # if i != 0:
                # data = self.__XOR(data, enecrypted_bytes[i - 1])
                data = self.__peremeshenie(data, True)
                data = self.__XOR(data, self.__bytes_to_matrix(keys[j][:16]))
                data = self.__change_bytes(data, True)
                data = self.__XOR(data, self.__bytes_to_matrix(keys[j][16:32]))
                data = self.__change_bytes(data, True)
                
            enecrypted_bytes.append(data)
        enecrypted_bytes = list(map(self.__matrix_to_bytes, enecrypted_bytes))
        enecrypted_bytes = list(map(bytes, enecrypted_bytes))
   
        return base64.b64encode(b''.join(enecrypted_bytes)).decode()
    
    
    def decrypt_all(self, enecrypted_bytes: str) -> str:
        import base64
        
        
        enecrypted_bytes = self.__razbit_decrypt(base64.b64decode(enecrypted_bytes))
        decrypted_bytes = []
        keys = self.__key_generation(self.key)
        for i in range(len(enecrypted_bytes)):
            i = len(enecrypted_bytes) - i - 1
            data = enecrypted_bytes[i]
            data = self.__bytes_to_matrix(data)
            for j in range(16):
                j = 15 - j
                data = self.__change_bytes(data, False)
                data = self.__XOR(data, self.__bytes_to_matrix(keys[j][16:32]))
                data = self.__change_bytes(data, False)
                data = self.__XOR(data, self.__bytes_to_matrix(keys[j][:16]))
                data = self.__peremeshenie(data, False)
                # if i != 0:
                # data = self.__XOR(data, bytes_to_matrix(enecrypted_bytes[i - 1]))
            decrypted_bytes.append(data)
        decrypted_bytes = list(reversed(decrypted_bytes))
        decrypted_bytes = list(map(self.__matrix_to_bytes, decrypted_bytes))
        enecrypted_bytes = list(map(bytes, decrypted_bytes))
        return b''.join(enecrypted_bytes)
    

key = str(1709947680.0)
c = CryptoProj(key)

a = FLAG
new = c.enecrypt_all(a)
print(new)
print()
new_new = c.decrypt_all(new)
print(new_new)

