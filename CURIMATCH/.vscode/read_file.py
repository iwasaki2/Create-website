# read_file.py
filename = 'your_file_here'  # 読み込みたいファイルのパスに置き換えてください

try:
    with open(filename, 'rb') as file:
        content = file.read()
        print(content)
except Exception as e:
    print(f"An error occurred: {e}")
