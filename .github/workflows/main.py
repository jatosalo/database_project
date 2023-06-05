import os
import json
import requests


def load_data():
    data = os.environ.get('github')
    if data is not None:
        return json.loads(data)


def get_channel_ids(user_ids, token):
    channels = []
    for user_id in user_ids:
        channels.append(
            requests.post(
                "https://discordapp.com/api/v6/users/@me/channels",
                headers={'authorization': f'Bot {token}'},
                json={'recipient_id': user_id},
            ).json()['id']
        )
    return channels


data = load_data()
with open('./config.json', 'r') as file:
    config = json.load(file)
embed = {}

EVENT_NAME = data.get('event_name')
REPOSITORY = data.get('repository')
event = data.get('event')

if EVENT_NAME == 'push':
    REF_NAME = data.get('ref_name')
    PUSHER = event.get('pusher').get('name')
    head_commit = event.get('head_commit')

    commits = event.get('commits')
    COMMIT_COUNT = len(commits)
    fields = [{'name': commit.get('message'), 'value': ''} for commit in commits]

    embed['title'] = f'[ PUSH ] {REPOSITORY}'
    embed[
        'description'
    ] = f'**{PUSHER}** push **{COMMIT_COUNT}** {"commit" if COMMIT_COUNT==1 else "commits"} to **{REF_NAME}**'
    embed['color'] = 0x5FC3FF
    embed['fields'] = fields

if embed != {}:
    token = os.environ.get('token')
    users = config.get('user', [])
    channels = get_channel_ids(users, token)
    for channel in channels:
        requests.post(
            f'https://discordapp.com/api/v6/channels/{channel}/messages',
            headers={'authorization': f'Bot {token}'},
            json={'embeds': [embed]},
        )