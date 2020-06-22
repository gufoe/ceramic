#!/bin/bash
cd "$(dirname "$0")/../"

error() {
  local parent_lineno="$1"
  local message="$2"
  local code="${3:-1}"
  if [[ -n "$message" ]] ; then
    echo "Error on or near line ${parent_lineno}: ${message}; error code: ${code}"
  else
    echo "Error on or near line ${parent_lineno}; error code: ${code}"
  fi
  # exec bash
  echo --- exiting ---
  exit 1
}
trap 'error ${LINENO}' ERR



echo downloading android studio...
cd ~
  [[ -d ./android-studio ]] || (
    wget -cO android.tgz https://redirector.gvt1.com/edgedl/android/studio/ide-zips/3.6.3.0/android-studio-ide-192.6392135-linux.tar.gz &&
    tar -xf ./android.tgz
  )
  cd ~/android-studio
  [[ -d ./tools ]] || (
    wget -cO tools.zip https://dl.google.com/android/repository/commandlinetools-linux-6200805_latest.zip &&
    unzip ./tools.zip
  )
  # export ANDROID_SDK_ROOT='~/android-studio'
  export ANDROID_HOME="$(pwd)"
  yes | ./tools/bin/sdkmanager --sdk_root=$(pwd) --licenses

cd /builder

echo starting...
export PATH="$PATH:~/.yarn/bin"

echo checking capacitor version...
cap -V 2> /dev/null || yarn global add @capacitor/cli
#
# echo checking npx version...
# npx -v 2> /dev/null || yarn global add npx

echo checking capacitor version...
node_modules/\@capacitor/cli/bin/capacitor -V 2> /dev/null || yarn add @capacitor/cli
[[ -d node_modules/\@capacitor/core ]] 2> /dev/null || yarn add @capacitor/core

echo cap init...
[[ -f capacitor.config.json ]] || cap init

echo cap add android...
[[ -d android ]] || cap add android

echo cap sync...
cap sync

# echo cap open android...
# cap open android

cd android
./gradlew --build-cache --configure-on-demand --parallel build -x lint -x lintVitalRelease
