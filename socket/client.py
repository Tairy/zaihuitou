from ws4py.client import WebSocketBaseClient
from ws4py.manager import WebSocketManager
from ws4py import format_addresses, configure_logger
import json
import gpio
from adc import analog_read

logger = configure_logger()

userid = "1407629972"

m = WebSocketManager()

class EchoClient(WebSocketBaseClient):
    def handshake_ok(self):
        logger.info("Opening %s" % format_addresses(self))
        m.add(self)

    def received_message(self, msg):
        print str(msg)
        pins = eval(str(msg))
        for pin in pins:
            gpio.pinMode(pin, gpio.OUTPUT)
            gpio.digitalWrite(pin,int(pins[pin]))

def tempread(pin):
    value = analog_read(pin)
    tempr = (value * 3.3)/4096*100
    return tempr

if __name__ == '__main__':
    import time

    try:
        m.start()
        client = EchoClient('ws://tairy.me:8888/ws')
        client.connect()

        sendmes = {"userid":userid}
        while True:
            for ws in m.websockets.itervalues():
                if not ws.terminated:
                    sendmes["data"] = {"temp":tempread(2)}
                    ws.send(json.JSONEncoder().encode(sendmes))
                    break
            else:
                break
            time.sleep(3)
    except KeyboardInterrupt:
        m.close_all()
        m.stop()
        m.join()