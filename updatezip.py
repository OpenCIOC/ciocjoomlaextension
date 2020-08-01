import os
import re
import shutil
import zipfile

from fnmatch import fnmatch

from xml.etree import ElementTree as ET

pkg_files = [
    'com_ciocrsd/ciocrsd.xml',
    'mod_ciocrsd/mod_ciocrsd.xml',
    'mod_ciocrsdbrowse/mod_ciocrsdbrowse.xml',
    'pkg_ciocrsd.xml',
]


version_re = re.compile('(<version>\d+\.\d+\.)(\d+)')


def bump(matchobj):
    ver = str(int(matchobj.group(2)) + 1)
    return matchobj.group(1) + ver


def bump_version(fname):
    with open(fname, 'rU') as src, open(fname + '.new', 'w') as dst:
        for line in src:
            if '<version>' in line:
                line = version_re.sub(bump, line)
            dst.write(line)

    shutil.move(fname + '.new', fname)


def main():
    try:
        os.path.unlink('../pkg_ciocrsd.cip')
    except:
        pass

    for target in ['mod_ciocrsd', 'mod_ciocrsdbrowse']:
        for ext in ['.ini', '.sys.ini']:
            srcname = 'en-GB.com_ciocrsd' + ext
            dstname = 'en-GB.' + target + ext
            shutil.copyfile(
                os.path.join(
                    'com_ciocrsd', 'admin', 'language', 'en-GB', srcname
                ),
                os.path.join(target, 'language', 'en-GB', dstname)
            )

    for fname in pkg_files:
        bump_version(fname)

    excludes = ['*.sw?', '.DS_Store', 'updatezip.*', '*.git*', '*.zip']
    with zipfile.ZipFile('../pkg_ciocrsd.zip', 'w', zipfile.ZIP_DEFLATED) as zip:
        for root, dirs, files in os.walk('.'):
            for fname in files:
                if any(fnmatch(fname, p) for p in excludes):
                    continue
                fullname = os.path.join(root, fname)
                zip.write(fullname, fullname[2:])
            if '.git' in dirs:
                dirs.remove('.git')

if __name__ == '__main__':
    main()
