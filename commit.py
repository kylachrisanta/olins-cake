import subprocess

def run(cmd):
    return subprocess.check_output(cmd, shell=True, text=True).strip()

status = run('git status --porcelain')
lines = status.split('\n')

for line in lines:
    if len(line) < 3: continue
    filepath = line[3:].strip()
    
    if filepath.startswith('"') and filepath.endswith('"'):
        filepath = filepath[1:-1]
        
    if ' -> ' in filepath:
        filepath = filepath.split(' -> ')[1]
    
    if not filepath: continue

    msg = 'chore: Memperbarui file ' + filepath.split('/')[-1]
    
    if 'admin_style.css' in filepath:
        msg = 'feat: Memperbarui gaya UI (Shadcn) di admin_style.css'
    elif 'admin/bagian' in filepath:
        msg = 'refactor: Memperbarui tata letak komponen admin di ' + filepath.split('/')[-1]
    elif 'auth/' in filepath or 'masuk' in filepath or 'daftar' in filepath:
        msg = 'refactor: Memperbarui halaman autentikasi ' + filepath.split('/')[-1]
    elif 'admin/kategori' in filepath:
        msg = 'feat: Memperbarui fitur kelola kategori di ' + filepath.split('/')[-1]
    elif 'admin/produk' in filepath:
        msg = 'feat: Memperbarui fitur kelola produk di ' + filepath.split('/')[-1]
    elif filepath.endswith('.php'):
        msg = 'refactor: Membersihkan komentar dan merapikan kode di ' + filepath.split('/')[-1]
    elif filepath.endswith('.css') or filepath.endswith('.js'):
        msg = 'feat: Menyesuaikan gaya dan logika script di ' + filepath.split('/')[-1]
    elif 'assets/images' in filepath:
        msg = 'chore: Menambahkan aset gambar baru'

    # Add single file
    try:
        run(f'git add "{filepath}"')
    except Exception:
        continue
    
    # Commit
    try:
        run(f'git commit -m "{msg}"')
        print(f'Committed: {filepath} -> {msg}')
    except Exception as e:
        pass

# Also add any deleted files that didn't get caught by explicit add
run('git add -A')
try:
    run('git commit -m "chore: Menghapus file usang dan membersihkan repositori"')
except:
    pass

try:
    run('git push origin main')
    print('Pushed to GitHub!')
except Exception as e:
    print(f'Error pushing: {e}')
