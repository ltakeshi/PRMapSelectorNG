# PRMapSelectorNG
先行試作型PRMapSelectorNG
デザイン等は最小限

## 仕様
### 設定ファイル
yaml/pr\_maps.yamlとyaml/pr\_rules.yamlを参照して以下のようなフォーマットの文字列を出力します。

* Al Basrah: INS Std
* Burning Sands: AAS Large
* Hill 488: AAS Alt
* Shijia Valley: C&C Std 

#### yaml/pr\_maps.yaml
yaml/pr\_maps.yamlはYAML形式になっており、以下のフォーマットとなっています。
<pre>
albasrah:
  name: Al Basrah
  mapsize: 2
  rules:
    - 5
    - 6
    - 7
</pre>
上記の例はAl Basrahですが、その他の場合も同様です。具体的には
<pre>
    albasrah:
</pre>
でプログラム内で参照される名前を設定します。すべて小文字で空白等は除去したものを使用します。
<pre>
    name: Al Basrah
</pre>
マップサイズを指定してます。これはマップ選択時のマップサイズでの絞り込み時に利用します
指定しなくても良いですが、その場合そのマップはマップサイズでの絞り込み対象になりません
<pre>
  mapsize: 2
</pre>
マップの正式名称を設定しています。これが最終的なフォーマットの出力の際に利用されます。特殊な文字が存在している場合はエスケープなどしてください。例としては以下のようになります。
<pre>
    name: 'Charlie''s Point'
</pre>
ルールを設定しているのは以下の行になります。
<pre>
	rules:
        - 6
    	- 7
    	- 8
</pre>
ルールはyaml/pr\_rules.yamlを参照しており、ルールを選択する際に使用されます。

#### yaml/pr\_rules.yaml
yaml/pr\_rules.yamlはYAML形式になっており、以下のフォーマットとなっています。
<pre>
1: AAS Inf
2: AAS Alt
</pre>
見れば分かるだろうから詳細は略。

### convert.php 及び bin/filecp.bat
convert.phpは {PRインストールディレクトリ}\mods\pr\levels\*\info\ 以下にある拡張子はpng(実態はddsフォーマット)をjpgに変換するためのスクリプトです  
pngディレクトリ下にあるファイルをjpgに変換すると同時にファイル名を適切な物に変更するスクリプトです

bin/filecp.batは {PRインストールディレクトリ}\mods\pr\levels\*\info\ 以下にあるloadbackground{1-4}.pngなファイルをコピーするプログラムです
コピー先は {PRインストールディレクトリ}\mods\pr\levels\pr\になっており、コピーすると同時にファイル名をマップ名{1-4}.pngに変更します

#### 使い方
1) filecp.batを {PRインストールディレクトリ}\mods\pr\levels\ にコピーする
2) filecp.batをダブルクリック(管理者権限を要求される可能性あり)
3) {PRインストールディレクトリ}\mods\pr\levels\ 下にあるprという名前のフォルダ内にあるpngファイルをサーバーの該当ディレクトリにアップロード
4) PRMapSelectorNGにアクセス
5) URLの末尾をconvert.phpに書き換えてアクセス
6) jpgディレクトリ内にある好きな画像をimgディレクトリにコピー(各マップ1枚)
7) imgディレクトリにコピーする際にマップ名最後についてる1～4の数字は消しておくこと(例: albasrah1.jpgを使う場合はalbasrah.jpgに変更する)


#### 課題
convert.phpで変換したjpgは一枚200kbほどあり、index.phpではそれが40枚ほど同時に読まれるので結構重たい

今後のデザイン次第ではあるが、convert時に"解像度を落とす/クオリティを落とす"などした方がよいかも

loadbackground*.pngのどれが良いか見ずに判断するのは厳しいと思うので、場合によってはloadbackground{1..4}.pngをアップロードしてもらって全て変換する手もありかも

そうした場合負荷的にはそこまで大したこと無いけど画像の指定方法は悩むところ




## 既知の問題

* (解決)マップを選択していなくてもルールを選択する画面に遷移できる。マップ選択ページにてJavascriptで対応しようと思ったけど、技術力不足により未実装。

