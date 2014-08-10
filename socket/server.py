import tornado.ioloop
import tornado.web
from tornado import websocket
import json
from pymongo import MongoClient
db = MongoClient().task
userinfodb = MongoClient().weichatuserinfo

class EchoWebSocket(websocket.WebSocketHandler):
    def check_origin(self, origin):
        return True

    def open(self):
        print 'open'
 
    def on_message(self, message):
        receive_mes = json.JSONDecoder().decode(message)
        userinfodb.userinfo.update({"user_id": int(receive_mes['userid'])}, {"$set": {"home_temp": receive_mes['data']['temp']}})
        print receive_mes['data']['temp']
        task_json = db.taskqueue.find_one({'user_id':int(receive_mes['userid'])})
        if task_json:
            db.taskqueue.remove({"_id":task_json["_id"]})
            task_name = str(task_json['task_name'])
            task_command_json = db.taskinfo.find_one({'task_name':task_name})            
            self.write_message(str(task_command_json['task_command']))
            # print task_command_json
        # print type(task_json)
        # task = json.JSONDecoder().decode(task_json)
        # print task['task_name']
 
    def on_close(self):
        print 'close'
 
class MainHandler(tornado.web.RequestHandler):
    def get(self):
        self.write("Hello, world")

application = tornado.web.Application([
    (r"/", MainHandler),
    (r"/ws", EchoWebSocket),
])
 
if __name__ == "__main__":
    application.listen(8888)
    tornado.ioloop.IOLoop.instance().start()