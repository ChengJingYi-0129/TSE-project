#include "PasswordEncryption.h"// implement the class
#include "passwordDecryption.hpp" //use components in the class
#include <string>
#include <iostream>
#include <vector>
#include <sstream>
#include <jni.h>

using namespace std;

// Global encryption object to maintain state
static ENCRYPTION encryptor;
static isdigit_expended IDE;

JNIEXPORT void JNICALL Java_PasswordEncryption_SetPassword(JNIEnv *env, jobject obj, jstring password) {
    const char *nativeString = env->GetStringUTFChars(password, 0);
    string cpp_password(nativeString);
    encryptor.SetPassword(cpp_password);
    env->ReleaseStringUTFChars(password, nativeString);
}

JNIEXPORT void JNICALL Java_PasswordEncryption_Set_1AES_116Byte_1Key(JNIEnv *env, jobject obj, jstring key) {
    const char *nativeString = env->GetStringUTFChars(key, 0);
    string cpp_key(nativeString);
    encryptor.Set_AES_16Byte_Key(cpp_key);
    env->ReleaseStringUTFChars(key, nativeString);
}

JNIEXPORT jstring JNICALL Java_PasswordEncryption_CAESAR_1CIPHER(JNIEnv *env, jobject obj, jstring choice) {
    const char *nativeString = env->GetStringUTFChars(choice, 0);
    int shift = stoi(string(nativeString));
    env->ReleaseStringUTFChars(choice, nativeString);
    
    string result = encryptor.CAESAR_CIPHER(shift);
    return env->NewStringUTF(result.c_str());
}

JNIEXPORT jstring JNICALL Java_PasswordEncryption_AES(JNIEnv *env, jobject obj) {
    string result = encryptor.AES();
    return env->NewStringUTF(result.c_str());
}

JNIEXPORT jboolean JNICALL Java_PasswordEncryption_isdigit2(JNIEnv *env, jobject obj, jstring CAESAR_CIPHER_key)
{
    const char *nativeString = env->GetStringUTFChars(CAESAR_CIPHER_key, 0);
    bool YesNo =IDE.isdigit2(string(nativeString));
    return YesNo ? JNI_TRUE : JNI_FALSE;
}

JNIEXPORT jboolean JNICALL Java_PasswordEncryption_ishexadigit(JNIEnv *env, jobject obj, jstring AES_16Byte_10rounds_key)
{
    const char *nativeString = env->GetStringUTFChars(AES_16Byte_10rounds_key, 0);
    bool YesNo = IDE.ishexadigit(string(nativeString));
    return YesNo ? JNI_TRUE : JNI_FALSE;
}