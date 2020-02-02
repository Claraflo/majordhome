cmake_minimum_required(VERSION 3.15)
project(App1 C)

set(CMAKE_C_STANDARD 99)

add_executable(App1  qrcodegen.c qrCode.c main.c)

