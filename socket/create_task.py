from pymongo import MongoClient
db = MongoClient().task

db.taskinfo.insert({'task_name':'0','task_command':{'gpio7':'1','gpio8':'0','gpio9':'1'}})