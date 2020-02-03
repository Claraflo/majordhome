cmake_minimum_required(VERSION 3.15)
project(App1 C)

set(CMAKE_C_STANDARD 99)

#find_package(PkgConfig REQUIRED)
#pkg_check_modules(GTK3 REQUIRED gtk+-3.0)

#include_directories(${GTK3_INCLUDE_DIRS})
#link_directories(${GTK3_LIBRARY_DIRS})

#add_definitions(${GTK3_CFLAGS_OTHER})

add_executable(App1  qrcodegen.c qrCode.c main.c)

#target_link_libraries(App1 ${GTK3_LIBRARIES})

