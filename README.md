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
	rules:
        - 6
    	- 7
    	- 8
</pre>
上記の例はAl Basrahですが、その他の場合も同様です。具体的には
<pre>
    albasrah:
</pre>
でプログラム内で参照される名前を設定します。すべて小文字で空白等は除去したものを使用します。
<pre>
    name: Al Basrah
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

### convert.php
convert.phpは {PRインストールディレクトリ}\mods\pr\levels\*\info\ 以下にある拡張子はpng(実態はddsフォーマット)をjpgに変換するためのスクリプトです  
png/マップ名.pngをimg/マップ名.jpgに変換するスクリプトとなってます  
#### 使い方
各マップの任意のloadbackground*.pngを"任意のマップ名.png"にリネームしてpngディレクトリ下に配置してください  
配置が終了した後にconvert.phpにアクセスすると自動的にimgディレクトリ下に"任意のマップ名.jpg"に変換されて出力されます  

なおマップ名はyaml/pr\_maps.yamlを参照します  
たとえばAl Basrahの場合はalbasrah.pngなどとしてください  

#### 課題
convert.phpで変換したjpgは一枚200kbほどあり、index.phpではそれが40枚ほど同時に読まれるので結構重たい

今後のデザイン次第ではあるが、convert時に"解像度を落とす/クオリティを落とす"などした方がよいかも

loadbackground*.pngのどれが良いか見ずに判断するのは厳しいと思うので、場合によってはloadbackground{1..4}.pngをアップロードしてもらって全て変換する手もありかも

そうした場合負荷的にはそこまで大したこと無いけど画像の指定方法は悩むところ


## 既知の問題

* マップを選択していなくてもルールを選択する画面に遷移できる。マップ選択ページにてJavascriptで対応しようと思ったけど、技術力不足により未実装。

