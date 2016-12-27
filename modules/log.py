from __future__ import unicode_literals
import os
import os.path
import threading
from datetime import datetime
import sopel.module
import sopel.tools
from sopel.config.types import StaticSection, FilenameAttribute

class ChanlogsSection(StaticSection):
    dir = FilenameAttribute('dir', directory=True, default='/home/paul/.sopel/chanlogs')

def configure(config):
    config.define_section('chanlogs', ChanlogsSection, validate=False)
    config.chanlogs.configure_setting(
            'dir',
            'Path to channel log storage director',
            )

def setup(bot):
    bot.config.define_section('chanlogs', ChanlogsSection)

    if not bot.memory.contains('chanlog_locks'):
        bot.memory['chanlog_locks'] = sopel.tools.SopelMemoryWithDefault(threading.Lock)

@sopel.module.rule(',*')
@sopel.module.unblockable
def log_everything(bot, trigger):
    fpath = os.path.join(bot.config.chanlogs.dir, "irc.log")
    message = ''.join(['<', trigger.nick, '> ', trigger, '\n'])
    with bot.memory['chanlog_locks'][fpath]:
        with open(fpath, "ab") as f:
            f.write(message.encode('utf8'))
