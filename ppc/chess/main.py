#!/usr/local/bin/python

import chess
import berserk
import random
from prettytable import PrettyTable


FLAG = "PolyCTF{R3m3m83R_K4w0?_D3d4!}"

API_TOKEN = "lip_kl3DpaHo9fD6ZJsmg0a0"
session = berserk.TokenSession(API_TOKEN)
client = berserk.Client(session=session)

# Fetch a chess puzzle
p = client.puzzles.get_daily()


puzzles = client.puzzles.get_puzzle_activity()
WOW = 0
for p in puzzles:
	try:
		puz = client.puzzles.get(p['puzzle']['id'])
		# print(puz)
		# puz = client.puzzles.get('5txKNXuq')
		moves = puz['game']['pgn'].split()

		# print(puz['puzzle']['solution'])
		# print(puz['puzzle']['solution'])
		solution = []
		s = ""
		for el in puz['puzzle']['solution']:
		    solution.append([el[0] + el[1], el[2] + el[3]])
		
		# print(solution)
		# print(puz)
		# print(moves)
		piece_map_tmp = {'N': 'knight', 'B': 'bishop', 'R': 'rook', 'Q': 'queen', 'K': 'king', '': 'pawn'}
		piece_map = dict((v, k) for k, v in piece_map_tmp.items())
		# c = chess.Chess(moves[:-len(moves) + 18])
		c = chess.Chess(moves)
		board = c.play_game()
		# print(board)
		solve = []
		for el in solution:
		    bp = [8 - int(el[0][1]), ord(el[0][0]) - ord('a')]
		    
		    piece = board[bp[0]][bp[1]].split("_")[1]
		    piece = piece_map[piece]
		    solve.append(piece + el[1])
		
		# print(solve)
		print(["white", "black"][c.TURN], "turn")
		

		# print(board)
		user_solve = []
		while len(user_solve) < len(solve) / 2:
		    piece_map_tmp = {'N': 'knight', 'B': 'bishop', 'R': 'rook', 'Q': 'queen', 'K': 'king', 'P': 'pawn'}
		    piece_map = dict((v, k) for k, v in piece_map_tmp.items())
		    # Define the size of the chess board
		    BOARD_SIZE = 8

		    # Create a PrettyTable instance
		    table = PrettyTable()

		    # Add the column headers (a-h)
		    table.field_names = [' '] + [chr(97 + i) for i in range(BOARD_SIZE)]
		    # Iterate over the rows
		    for i in range(BOARD_SIZE):
		        # Initialize an empty row
		        row = [str(8 - i)]
		        
		        # Iterate over the columns
		        for j in range(BOARD_SIZE):
		            # If the sum of the row and column indices is even, it's a light square
		            # if (i + j) % 2 == 0:
		            if board[i][j] != None:
		                p = board[i][j].split("_")
		                # print(p, piece_map[p[1]])
		                if p[0] == 'black':
		                    # row.append(f'\033[47m\033[30m {}\033[0m')  # Light square (white)
		                    row.append(f'\033[44m\033[30m {piece_map[p[1]]} \033[0m')
		                elif p[0] == 'white':
		                    # row.append(f'\033[40m\033[37m {}\033[0m')  # Dark square (gray)
		                    row.append(f'\033[44m\033[37m {piece_map[p[1]]} \033[0m')
		            else:
		                row.append('\033[44m   \033[0m')
		                
		        # Add the row to the table
		        table.add_row(row, divider=True)

		    # Print the chess board with horizontal lines
		    print(table.get_string(header=True, border=True))
		    
		    user_input = input("best move >> ")
		    # print(user_input, solve[2 * len(user_solve)], user_input == solve[2 * len(user_solve)])
		    if user_input == solve[2 * len(user_solve)]:
		        print("good")
		    user_solve.append(user_input)
		    # c.add_move(user_input)
		    moves.append(user_input)
		    if len(user_solve) > len(solve) / 2:
		        break
		    # c.add_move(solve[2 * len(user_solve) + 1])
		    moves.append(solve[2 * len(user_solve) - 1])
		    
		    del c
		    c = chess.Chess(moves)
		    # c.initialize_board()
		    board = c.play_game()
		    # print(len(user_solve) < len(solve) / 2)
		
		WOW += 1
		print(f"Won. {100 - WOW} / 100 left")
		    
		del c
		
		if WOW >= 100:
		    print("You won. Here is the flag =", FLAG)
		    break
	except UnboundLocalError:
		pass
	except AttributeError:
		pass

print("You won by accident. Here is the flag =", FLAG)
