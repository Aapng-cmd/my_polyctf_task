#!/usr/bin/env python3
import random


def generate_random_string(length):
    return ''.join(chr(random.randint(33, 126)) for _ in range(length))


'''
def get_letters():

    a = f"""
       {generate_random_string(1)}   
      {generate_random_string(1)} {generate_random_string(1)}  
     {generate_random_string(5)} 
    {generate_random_string(1)}     {generate_random_string(1)}
    """

    b = f"""
    {generate_random_string(4)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(4)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(4)}
    """

    c = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}   {generate_random_string(1)}
      {generate_random_string(1)}
      {generate_random_string(1)}
       {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    d = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    e = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    f = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    """

    g = f"""
        {generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}  {generate_random_string(1)}
      {generate_random_string(1)}    {generate_random_string(1)}
     {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
     {generate_random_string(1)}     {generate_random_string(1)}
      {generate_random_string(1)}   {generate_random_string(1)}
       {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    h = f"""
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    """

    i = f"""
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    """

    j = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
      {generate_random_string(1)}
      {generate_random_string(1)}
      {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}
    """

    k = f"""
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    """

    l = f"""
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    m = f"""
    {generate_random_string(1)}    {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}  {generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)}{generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}    {generate_random_string(1)}
    {generate_random_string(1)}    {generate_random_string(1)}
    """

    n = f"""
    {generate_random_string(1)}    {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}    {generate_random_string(1)}
    """

    o = f"""
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    p = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}
    """

    q = f"""
     {generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)}{generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
    """

    r = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    """

    s = f"""
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    {generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    t = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}
       {generate_random_string(1)}
       {generate_random_string(1)}
       {generate_random_string(1)}
    """

    u = f"""
    {generate_random_string(1)}    {generate_random_string(1)}
    {generate_random_string(1)}    {generate_random_string(1)}
    {generate_random_string(1)}    {generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    v = f"""
    {generate_random_string(1)}     {generate_random_string(1)}
     {generate_random_string(1)}   {generate_random_string(1)}
      {generate_random_string(1)} {generate_random_string(1)}
       {generate_random_string(1)}
    """

    w = f"""
    {generate_random_string(1)}  {generate_random_string(1)}  {generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)} {generate_random_string(1)}{generate_random_string(1)}
    """

    x = f"""
    {generate_random_string(1)}   {generate_random_string(1)}
     {generate_random_string(1)} {generate_random_string(1)}
      {generate_random_string(1)}
     {generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}   {generate_random_string(1)}
    """

    y = f"""
    {generate_random_string(1)}   {generate_random_string(1)}
     {generate_random_string(1)} {generate_random_string(1)}
      {generate_random_string(1)}
      {generate_random_string(1)}
      {generate_random_string(1)}
    """

    z = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}
      {generate_random_string(1)}
     {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    _ = f"""
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    _0 = f"""
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}{generate_random_string(1)}
    {generate_random_string(1)} {generate_random_string(1)} {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}  {generate_random_string(1)}
     {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    _1 = f"""
        {generate_random_string(1)}
       {generate_random_string(1)}{generate_random_string(1)}
      {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
    """

    _2 = f"""
       {generate_random_string(1)}
      {generate_random_string(1)} {generate_random_string(1)}
     {generate_random_string(1)}   {generate_random_string(1)}
         {generate_random_string(1)}
        {generate_random_string(1)}
       {generate_random_string(1)}
      {generate_random_string(1)}
     {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
    """

    _4 = f"""
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}  {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}
       {generate_random_string(1)}
    """

    __ = f"""
    {generate_random_string(1)}
    {generate_random_string(1)}
    {generate_random_string(1)}


    {generate_random_string(1)}
    """

    fig_l = f"""
        {generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}
      {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}
     {generate_random_string(1)}
      {generate_random_string(1)}
       {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}
    """

    fig_r = f"""
    {generate_random_string(1)}{generate_random_string(1)}
      {generate_random_string(1)}
       {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}
       {generate_random_string(1)}
      {generate_random_string(1)}
    {generate_random_string(1)}{generate_random_string(1)}
    """

    letters = {"a": a, "b": b, "c": c, "d": d, "e": e, "f": f, "g": g, "h": h, "i": i, "j": j, "k": k, "l": l, "m": m
        , "n": n, "o": o, "p": p, "q": q, "r": r, "s": s, "t": t, "u": u, "v": v, "w": w, "x": x, "y": y, "z": z
        , "_": _, "1": _1, "4": _4, "0": _0, "!": __, "{": fig_l, "}": fig_r}

    return letters
'''

def get_letter(L):
    a = f"""
           {generate_random_string(1)}   
          {generate_random_string(1)} {generate_random_string(1)}  
         {generate_random_string(5)} 
        {generate_random_string(1)}     {generate_random_string(1)}
        """

    b = f"""
        {generate_random_string(4)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(4)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(4)}
        """

    c = f"""
            {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}   {generate_random_string(1)}
          {generate_random_string(1)}
          {generate_random_string(1)}
           {generate_random_string(1)}   {generate_random_string(1)}
            {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    d = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    e = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    f = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        """

    g = f"""
            {generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}  {generate_random_string(1)}
          {generate_random_string(1)}    {generate_random_string(1)}
         {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
         {generate_random_string(1)}     {generate_random_string(1)}
          {generate_random_string(1)}   {generate_random_string(1)}
           {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    h = f"""
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        """

    i = f"""
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        """

    j = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
          {generate_random_string(1)}
          {generate_random_string(1)}
          {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}
        """

    k = f"""
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        """

    l = f"""
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    m = f"""
        {generate_random_string(1)}    {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}  {generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)}{generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}    {generate_random_string(1)}
        {generate_random_string(1)}    {generate_random_string(1)}
        """

    n = f"""
        {generate_random_string(1)}    {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}    {generate_random_string(1)}
        """

    o = f"""
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    p = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}
        """

    q = f"""
         {generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)}{generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
            {generate_random_string(1)}
        """

    r = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        """

    s = f"""
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        {generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
            {generate_random_string(1)}
            {generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    t = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}
           {generate_random_string(1)}
           {generate_random_string(1)}
           {generate_random_string(1)}
        """

    u = f"""
        {generate_random_string(1)}    {generate_random_string(1)}
        {generate_random_string(1)}    {generate_random_string(1)}
        {generate_random_string(1)}    {generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    v = f"""
        {generate_random_string(1)}     {generate_random_string(1)}
         {generate_random_string(1)}   {generate_random_string(1)}
          {generate_random_string(1)} {generate_random_string(1)}
           {generate_random_string(1)}
        """

    w = f"""
        {generate_random_string(1)}  {generate_random_string(1)}  {generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)} {generate_random_string(1)}{generate_random_string(1)}
        """

    x = f"""
        {generate_random_string(1)}   {generate_random_string(1)}
         {generate_random_string(1)} {generate_random_string(1)}
          {generate_random_string(1)}
         {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}   {generate_random_string(1)}
        """

    y = f"""
        {generate_random_string(1)}   {generate_random_string(1)}
         {generate_random_string(1)} {generate_random_string(1)}
          {generate_random_string(1)}
          {generate_random_string(1)}
          {generate_random_string(1)}
        """

    z = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}
          {generate_random_string(1)}
         {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    _ = f"""
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    _0 = f"""
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}{generate_random_string(1)}
        {generate_random_string(1)} {generate_random_string(1)} {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}  {generate_random_string(1)}
         {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    _1 = f"""
            {generate_random_string(1)}
           {generate_random_string(1)}{generate_random_string(1)}
          {generate_random_string(1)} {generate_random_string(1)}
            {generate_random_string(1)}
            {generate_random_string(1)}
        """

    _2 = f"""
           {generate_random_string(1)}
          {generate_random_string(1)} {generate_random_string(1)}
         {generate_random_string(1)}   {generate_random_string(1)}
             {generate_random_string(1)}
            {generate_random_string(1)}
           {generate_random_string(1)}
          {generate_random_string(1)}
         {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
        """

    _4 = f"""
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}  {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}
           {generate_random_string(1)}
        """

    __ = f"""
        {generate_random_string(1)}
        {generate_random_string(1)}
        {generate_random_string(1)}


        {generate_random_string(1)}
        """

    fig_l = f"""
            {generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}
          {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}
         {generate_random_string(1)}
          {generate_random_string(1)}
           {generate_random_string(1)}
            {generate_random_string(1)}{generate_random_string(1)}
        """

    fig_r = f"""
        {generate_random_string(1)}{generate_random_string(1)}
          {generate_random_string(1)}
           {generate_random_string(1)}
            {generate_random_string(1)}{generate_random_string(1)}
           {generate_random_string(1)}
          {generate_random_string(1)}
        {generate_random_string(1)}{generate_random_string(1)}
        """

    if L == "a":
        let = a
    elif L == "b":
        let = b
    elif L == "c":
        let = c
    elif L == "d":
        let = d
    elif L == "e":
        let = e
    elif L == "f":
        let = f
    elif L == "g":
        let = g
    elif L == "h":
        let = h
    elif L == "i":
        let = i
    elif L == "j":
        let = j
    elif L == "k":
        let = k
    elif L == "l":
        let = l
    elif L == "m":
        let = m
    elif L == "n":
        let = n
    elif L == "o":
        let = o
    elif L == "p":
        let = p
    elif L == "q":
        let = q
    elif L == "r":
        let = r
    elif L == "s":
        let = s
    elif L == "t":
        let = t
    elif L == "u":
        let = u
    elif L == "v":
        let = v
    elif L == "w":
        let = w
    elif L == "x":
        let = x
    elif L == "y":
        let = y
    elif L == "z":
        let = z
    elif L == "_":
        let = _
    elif L == "0":
        let = _0
    elif L == "1":
        let = _1
    elif L == "2":
        let = _2
    elif L == "4":
        let = _4
    elif L == "!":
        let = __
    elif L == "{":
        let = fig_l
    elif L == "}":
        let = fig_r

    return let

def filter_string(main_string, reference_string):
    # Convert both strings to sets for efficient lookups
    main_set = set(main_string)
    reference_set = set(reference_string)

    # Check if all characters in main_string are present in reference_string
    if main_set.issubset(reference_set):
        return main_string
    else:
        # Filter out characters not present in reference_string
        filtered_string = ''.join([char for char in main_string if char in reference_set])
        return filtered_string


def generate_spec_string(string):
    ans = []
    ANS1 = []
    ANS = []
    s = ""
    m = 0
    for el in string:
        ans.append(get_letter(el))
        m = max(m, get_letter(el).count("\n") + 1)
    mm = 0
    for el in range(len(ans)):
        while ans[el].count("\n") < m:
            ans[el] = "\n" + ans[el]
        mm = max(mm, max([len(x) for x in ans[el].split("\n")]))
    for el in range(len(ans)):
        for _ in range(m):
            bob = ans[el].split("\n")[_]
            shift = mm - len(bob)
            if shift > 0:
                bob = bob + " " * shift + "\n"
            else:
                bob = bob + "\n"
            ANS1.append(bob)
        ANS.append("".join(ANS1))
        ANS1 = []
        # print(ANS[el].replace(" ", "+"))

    for _ in range(m):
        for el in ANS:
            el = el.split("\n")
            # print("\n".join(el))
            s += el[_].replace("\n", "")
            s += "  "
        s += "\n"
    # print(s)
    return s



print("А ты готов вводить буковки сто раз? (расслабься, регистр - нижний)\n")
Q = 0
FLAG = "PolyCTF{Wh4t_4n_0cr_1!}".lower()
KEYS = 'abcdefghijklmnopqrstuvwxyz_140!{}'
ans_arr = []
while Q < 150:
    # print(generate_spec_string(letters, FLAG))
    ans = filter_string(generate_random_string(random.randint(10, 20) + Q // 10).lower(), KEYS)
    ans_obf = generate_spec_string(ans)
    print(ans_obf)
    # print(ans)
    ans_user = input()
    # print(ans_user)
    # print(ans, ans_user)
    if ans_user.strip() == ans.strip():
        print("Правильно!\n")
        Q += 1
    else:
        print("Неправильно!\n")

    if Q == 100:
        print("Объегорен.\nДавай ещё 50.\n")

    if Q == 150:
        print("Победа, вот флаг (всё в фигурных скобках нижним регистром)!\n")
        print(generate_spec_string(FLAG))
        break
