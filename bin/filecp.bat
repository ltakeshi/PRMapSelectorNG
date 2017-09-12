mkdir pr
for /d %%a in (*) do (
 copy %%a\info\loadbackground1.png pr\%%a_1.png
 copy %%a\info\loadbackground2.png pr\%%a_2.png
 copy %%a\info\loadbackground3.png pr\%%a_3.png
 copy %%a\info\loadbackground4.png pr\%%a_4.png
)