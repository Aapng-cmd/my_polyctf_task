#!/usr/bin/python3
import os
import stat
import sys

def set_suid(binary_path):
    try:
        # Check if the file exists
        if not os.path.isfile(binary_path):
            print(f"Error: {binary_path} does not exist.")
            return
        
        if "/home/stitch/" not in binary_path:
            print("You need file to be in stitch home directory")
            return
        # Get the current permissions of the file
        current_permissions = stat.S_IMODE(os.lstat(binary_path).st_mode)
        
        # Set the SUID bit
        new_permissions = current_permissions | stat.S_ISUID
        os.chmod(binary_path, new_permissions)
        
        print(f"SUID bit set on {binary_path}.")
        
    except PermissionError:
        print("Error: You need to run this script as root to set the SUID bit.")
    except Exception as e:
        print(f"An error occurred: {e}")

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python patch.py <path_to_binary>")
        sys.exit(1)

    binary_path = sys.argv[1]
    set_suid(binary_path)
