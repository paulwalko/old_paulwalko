import sopel.module

@sopel.module.commands('vtbash')
def vtbash(bot, trigger):
    args = trigger.group(2).split(' ')
    args = ''.join(args)
    beg = args[0]
    begNum = args[1]
    end = args[2]
    endNum = args[3]
    bot.say(end)
