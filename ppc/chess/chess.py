class Chess:
    def __init__(self, moves):
        self.moves = moves
        self.TURN = 0
        self.piece_positions = {}
        self.board = self.initialize_board()

    def initialize_board(self):
        board = [[None for _ in range(8)] for _ in range(8)]
        starting_positions = {
            'white': {
                'king': (7, 4),
                'queen': (7, 3),
                'rook': [(7, 0), (7, 7)],
                'bishop': [(7, 2), (7, 5)],
                'knight': [(7, 1), (7, 6)],
                'pawn': [(6, i) for i in range(8)]
            },
            'black': {
                'king': (0, 4),
                'queen': (0, 3),
                'rook': [(0, 0), (0, 7)],
                'bishop': [(0, 2), (0, 5)],
                'knight': [(0, 1), (0, 6)],
                'pawn': [(1, i) for i in range(8)]
            }
        }
        
        for color, pieces in starting_positions.items():
            for piece, positions in pieces.items():
                if isinstance(positions, list):
                    for i, position in enumerate(positions):
                        if piece == 'pawn':
                            board[position[0]][position[1]] = f"{color}_pawn_{chr(97 + i)}"
                            self.piece_positions[f"{color}_pawn_{chr(97 + i)}"] = position
                        elif piece == 'rook':
                            board[position[0]][position[1]] = f"{color}_rook_{chr(97 + i)}"
                            self.piece_positions[f"{color}_rook_{chr(97 + i)}"] = position
                        elif piece == 'bishop':
                            board[position[0]][position[1]] = f"{color}_bishop_{chr(97 + i)}"
                            self.piece_positions[f"{color}_bishop_{chr(97 + i)}"] = position
                        elif piece == 'knight':
                            board[position[0]][position[1]] = f"{color}_knight_{chr(97 + i)}"
                            self.piece_positions[f"{color}_knight_{chr(97 + i)}"] = position
                        else:
                            board[position[0]][position[1]] = f"{color}_{piece}"
                            self.piece_positions[f"{color}_{piece}"] = position
                else:
                    board[positions[0]][positions[1]] = f"{color}_{piece}"
                    self.piece_positions[f"{color}_{piece}"] = positions
                    
        return board

    def algebraic_to_coordinates(self, algebraic):
        x = ord(algebraic[0]) - 97
        y = 8 - int(algebraic[1])
        return y, x
        
    def find_king_position(self, color):
        for i in range(8):
            for j in range(8):
                piece = self.board[i][j]
                if piece is not None and piece.split("_")[0] == color and piece.split('_')[1] == 'king':
                    return (j, 7 - i)
        return None

    def parse_move(self, move):
        piece_map = {'N': 'knight', 'B': 'bishop', 'R': 'rook', 'Q': 'queen', 'K': 'king', 'P': 'pawn'}
        check = False
        if move.endswith('+'):
            check = True
            move = move[:-1]
        
        if move in ['O-O', 'O-O+']:
            # Short castling
            piece = 'king'
            start = (7, 4) if self.TURN == 0 else (0, 4)  # King position
            end = (7, 6) if self.TURN == 0 else (0, 6)    # King new position
            
            # print(start, end, "WOW")
            
            disambiguation = None
            return piece, start, end, disambiguation, check
        elif move in ['O-O-O', 'O-O-O+']:
            # Long castling
            piece = 'king'
            start = (4, 7) if self.TURN == 0 else (4, 0)  # King position
            end = (2, 7) if self.TURN == 0 else (2, 0)    # King new position
            disambiguation = None
            return piece, start, end, disambiguation, check
        
        elif 'x' in move:
            move_parts = move.split('x')
            piece = move_parts [0][0].upper() if move_parts[0][0].islower() else move_parts[0][0]
            piece = piece_map.get(piece, 'pawn')
            if len(move_parts[0]) > 1:
                disambiguation = move_parts[0][1]
            else:
                disambiguation = None
            destination = move_parts[1]
        elif move[0].isupper():
            piece = piece_map[move[0]]
            if len(move) - 1 > 2:
                disambiguation = move[1]
                destination = move[2:]
            else:
                disambiguation = None
                destination = move[1:]
        else:
            piece = 'pawn'
            disambiguation = None
            destination = move
        start = self.find_starting_position(piece + "_" + ["white", "black"][self.TURN], destination)
        end = self.algebraic_to_coordinates(destination)
        return piece, start, end, disambiguation, check

    def find_starting_position(self, piece, destination):
        color, piece = piece.split("_")
        # color = 'white' if piece in ['king', 'queen', 'rook', 'bishop', 'knight'] else 'black'
        for key, value in self.piece_positions.items():
            # value = (int(value[1]), 8 - int(value[0]) + 1)
            # print(key, value)
            if key.startswith(f"{piece}_{color}") and value:
                if self.is_valid_move(key, value, destination):
                    return value
        return None

    def is_valid_move(self, piece, start, end):
        piece_type = piece.split('_')[1]
        piece_color = piece.split('_')[0]
        piece_moves = {
            'king': self.king_moves,
            'queen': self.queen_moves,
            'rook': self.rook_moves,
            'bishop': self.bishop_moves,
            'knight': self.knight_moves,
            'pawn': self.pawn_moves
        }
        
        x2, y2 = end
        x2 = ord(x2) - ord('a')
        y2 = 8 - int(y2)
        end = (x2, y2)
        
        if piece_type == 'pawn':
            if piece_moves[piece_type](start, end, piece_color):
                return self.is_path_clear(start, end)
            else:
                return False
        else:
            if piece_moves[piece_type](start, end):
                return self.is_path_clear(start, end)
            else:
                return False

    def is_path_clear(self, start, end):
        y1, x1 = start
        x2, y2 = end
        dx = x2 - x1
        dy = y2 - y1
        
        if dx == 0:  # Vertical move
            for i in range(min(y1, y2) + 1, max(y1, y2)):
                if self.board[i][x1] is not None:
                    return False
        elif dy == 0:  # Horizontal move
            for i in range(min(x1, x2) + 1, max(x1, x2)):
                if self.board[y1][i] is not None:
                    return False
        elif abs(dx) == abs(dy):  # Diagonal move
            for i in range(1, abs(dx)):
                if self.board[y1 + i * dy // abs(dy)][x1 + i * dx // abs(dx)] is not None:
                    return False
        return True
            
    def king_moves(self, start, end):
        y1, x1 = start
        x2, y2 = end
        dx = abs(x2 - x1)
        dy = abs(y2 - y1)
        return (dx == 1 and dy == 0) or (dx == 0 and dy == 1) or (dx == 1 and dy == 1)

    def queen_moves(self, start, end):
        y1, x1 = start
        x2, y2 = end
        dx = abs(x2 - x1)
        dy = abs(y2 - y1)
        return (dx == 0 and dy != 0) or (dx != 0 and dy == 0) or (dx == dy)

    def rook_moves(self, start, end):
        y1, x1 = start
        x2, y2 = end
        return (x1 == x2) or (y1 == y2)

    def bishop_moves(self, start, end):
        y1, x1 = start
        x2, y2 = end
        dx = abs(x2 - x1)
        dy = abs(y2 - y1)
        return dx == dy

    def knight_moves(self, start, end):
        y1, x1 = start
        x2, y2 = end
        dx = abs(x2 - x1)
        dy = abs(y2 - y1)
        return (dx == 2 and dy == 1) or (dx == 1 and dy == 2)

    def pawn_moves(self, start, end, piece_color):
        y1, x1 = start
        x2, y2 = end
        
        if piece_color == 'black':
            if y1 == 1 and y2 == 3 and x1 == x2:  # Initial move
                return True
            if y1 + 1 == y2 and x1 == x2:  # Move forward
                return self.board[y2][x2] is None
            if y1 + 1 == y2 and abs(x1 - x2) == 1:  # Capture diagonally
                return self.board[y2][x2] is not None and self.board[y2][x2].startswith('white')
        else:
            if y1 == 6 and y2 == 4 and x1 == x2:  # Initial move
                return True
            if y1 - 1 == y2 and x1 == x2:  # Move forward
                return self.board[y2][x2] is None
            if y1 - 1 == y2 and abs(x1 - x2) == 1:  # Capture diagonally
                return self.board[y2][x2] is not None and self.board[y2][x2].startswith('black')
        return False

    def update_board(self, move):
        piece, start, end, disambiguation, check = self.parse_move(move)
        # print(piece, start, end, disambiguation, check)
        if piece == 'king' and (move in ['O-O', 'O-O+']):
            # Short castling
            # king_start = self.find_king_position(["white", "black"][self.TURN])
            # king_end = (king_start[1], king_start[0] + 2)
            king_start = start
            king_end = end
            rook_start = (king_start[0], king_start[1] + 3)
            rook_end = (king_start[0], king_start[1] + 1)
            # print(king_start, king_end)
            # print(rook_start, rook_end)
            
            self.remove_piece(king_start)
            self.remove_piece(rook_start)
            
            self.update_piece_position(["white", "black"][self.TURN] + "_" + "king", king_end)
            self.board[king_end[0]][king_end[1]] = ["white", "black"][self.TURN] + "_" + "king"
            self.update_piece_position(["white", "black"][self.TURN] + "_" + "rook", rook_end)
            self.board[rook_end[0]][rook_end[1]] = ["white", "black"][self.TURN] + "_" + "rook"
            
        elif piece == 'king' and (move in ['O-O-O', 'O-O-O+']):
            # Long castling
            king_start = start
            king_end = end
            rook_start = (king_start[0], king_start[1] - 4)
            rook_end = (king_start[0], king_start[1] - 1)
            
            self.remove_piece(king_start)
            self.remove_piece(rook_start)
            
            self.update_piece_position(["white", "black"][self.TURN] + "_" + "king", king_end)
            self.board[king_end[0]][king_end[1]] = ["white", "black"][self.TURN] + "_" + "king"
            self.update_piece_position(["white", "black"][self.TURN] + "_" + "rook", rook_end)
            self.board[rook_end[0]][rook_end[1]] = ["white", "black"][self.TURN] + "_" + "rook"
        
        else:
            # Normal move handling
            for key, value in self.piece_positions.items():
                if value == start:
                    piece_name = key
                    break
                    
            if start:
                self.remove_piece(start)

            if self.board[end[0]][end[1]]:  # If there's a piece at the destination, remove it
                self.remove_piece(end)

            self.update_piece_position(piece_name, end)
            self.board[end[0]][end[1]] = piece_name

        self.TURN = (self.TURN + 1) % 2
        return self.board

    def remove_piece(self, position):
        for key, value in self.piece_positions.items():
            if value == position:
                del self.piece_positions[key]
                self.board[position[0]][position[1]] = None
                break

    def update_piece_position(self, piece, position):
        self.piece_positions[piece] = position
    
    def add_move(self, move):
        self.moves.append(move)
    
    def play_game(self):
        for move in self.moves:
            self.board = self.update_board(move)
        return self.board
