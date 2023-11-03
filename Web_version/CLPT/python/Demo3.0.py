#!/usr/bin/env python
# coding: utf-8

# In[1]:

import jieba #斷詞
import csv
import  re
import sys
# txt = open("test.txt",'r', encoding="utf-8").read()
input_data = sys.argv[1] #命令列的引數，包括指令碼名稱
# Excel = open("test.csv", 'r+', newline = '')
# writ = csv.writer(Excel)
# writ.writerow(['詞','出現次數'])
#斷詞
words = jieba.lcut(input_data)
#次數統計
counts ={} 
for word in words:
    if len(word) <= 1:
        continue
    else:
        counts[word] = counts.get(word, 0) + 1 #字返回次數加一
item = list(counts.items()) #轉為列表格式
item.sort(key = lambda x:x[1], reverse = True) #排序
print('詞','出現次數')
for i in item:
    # writ.writerow(item[i])
    print(i)


# In[ ]:




